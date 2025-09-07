<?php

namespace Tests\Feature;

use App\Models\Option;
use App\Models\PreOrder;
use App\Models\Raffle;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class R4FlowTest extends TestCase
{
    use RefreshDatabase;

    protected string $commerce;
    protected string $authToken;

    protected function setUp(): void
    {
        parent::setUp();

        // Set Commerce token for legacy paths (kept for completeness)
        $this->commerce = 'test-commerce-token-123';
        putenv('R4_COMMERCE='.$this->commerce);
        $_ENV['R4_COMMERCE'] = $this->commerce;
        $_SERVER['R4_COMMERCE'] = $this->commerce;

        // Ensure Authorization UUID token for new R4 middleware
        $this->authToken = (string) env('R4_AUTH_TOKEN', '');
        if (empty($this->authToken)) {
            $this->authToken = (string) \Illuminate\Support\Str::uuid();
            putenv('R4_AUTH_TOKEN='.$this->authToken);
            $_ENV['R4_AUTH_TOKEN'] = $this->authToken;
            $_SERVER['R4_AUTH_TOKEN'] = $this->authToken;
        }

        // Base data
        $this->raffleId = Raffle::create([
            'precio' => 89,
            'cantidad_max' => 10000,
            'nombre' => 'Rifa Test',
            'fecha_inicial' => now()->subDay()->toDateString(),
            'fecha_final' => now()->addDay()->toDateString(),
        ])->id;

        Option::create([
            'clave' => 'BCV',
            'valor' => '115',
        ]);
    }

    // Legacy helper left in place (not used by new endpoints)
    protected function hmacAuth(): string { return hash_hmac('sha256', 'Banco', $this->commerce); }

    public function test_full_r4_flow_with_preorder_and_order_auto_approval(): void
    {
        // Avoid external IP middleware noise
        $this->withoutMiddleware(\Softronic\Ipquery\Middleware\IpqueryMiddleware::class);

        Storage::fake('public');

        // 1) Create PreOrder
        $preOrderResp = $this->postJson('/api/preOrder', [
            'raffle_id' => $this->raffleId,
            'cantidad' => 4,
            'cedula' => 'V18671986',
            'nombre_completo' => 'Cliente Prueba',
            'correo' => 'cliente@example.com',
            'telefono' => '04121112223',
            'bank_code' => '0102',
        ]);
        $preOrderResp->assertCreated()->assertJsonPath('success', true);
        $pre = PreOrder::firstOrFail();

        // 2) R4consulta con monto incorrecto -> false (usa Authorization UUID + TelefonoComercio)
        $wrong = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $this->authToken,
        ])->postJson('/api/R4consulta', [
            'IdCliente' => '18671986',
            'TelefonoComercio' => '04121112223',
            'Monto' => 150.00,
        ]);
        $wrong->assertOk()->assertJson(['status' => false]);

        // 3) R4consulta con monto correcto -> true (usa Authorization UUID + TelefonoComercio)
        $right = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $this->authToken,
        ])->postJson('/api/R4consulta', [
            'IdCliente' => '18671986',
            'TelefonoComercio' => '04121112223',
            'Monto' => (float) $pre->monto,
        ]);
        $right->assertOk()->assertJson(['status' => true]);

        // 4) R4notifica (code 00) antes de que el usuario termine el formulario
        $notifica = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $this->authToken,
        ])->postJson('/api/R4notifica', [
            'IdComercio' => '13536734',
            'TelefonoComercio' => '04121112223',
            'TelefonoEmisor' => '04121112223',
            'Concepto' => 'PRUEBA',
            'Banco' => '0102',
            'Referencia' => '12345678',
            'Monto' => (float) $pre->monto,
            'CodigoRed' => '00',
            'FechaHora' => now()->toIso8601String(),
        ]);
        $notifica->assertOk()->assertJson(['abono' => true]);

        $pre->refresh();
        $this->assertTrue((bool) $pre->notificado);
        $this->assertEquals('12345678', $pre->ref_banco);

        // 5) Usuario termina el formulario de compra -> se debe auto-aprobar por pre_orden notificada
        $file = UploadedFile::fake()->image('capture.png');
        $params = [
            'raffle_id' => $this->raffleId,
            'nombre_completo' => 'Cliente Prueba',
            'correo' => 'cliente@example.com',
            'tlf' => '04121112223',
            'cantidad' => 4,
            'cedula' => '18671986', // sin prefijo, backend normaliza
            'ref_banco' => '12345678',
            'bank_code' => '0102',
            'pre_order_uuid' => $pre->uuid,
            'ref_fecha' => now()->toDateString(),
            'ref_imagen' => $file,
        ];
        $orderResp = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'multipart/form-data',
        ])->post('/api/orderCliente', $params);

        // Debug on failure
        if ($orderResp->status() !== 201) {
            $this->fail('Order create failed: '.$orderResp->getContent());
        }
        $orderResp->assertJsonPath('success', true);

        $order = Order::latest('id')->firstOrFail();
        $this->assertEquals('1', $order->estatus, 'Order debe quedar aprobada');
        $this->assertEquals($pre->id, $order->pre_order_id);
        $this->assertEquals('0102', $order->bank_code);
        $this->assertEquals('12345678', $order->ref_banco);
        $this->assertEquals((string) $pre->monto, (string) $order->monto_notificado_bs);
    }
}
