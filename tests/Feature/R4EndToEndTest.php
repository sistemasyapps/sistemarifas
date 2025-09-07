<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use App\Models\Raffle;
use App\Models\Order;
use App\Models\PreOrder;
use App\Jobs\CreateTickets;
use App\Models\Option;
use Illuminate\Support\Facades\DB;
use App\Jobs\ApproveOrderJob;
use Illuminate\Support\Facades\Storage;

class R4EndToEndTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Set required env for middleware: prefer existing .env value
        $token = env('R4_AUTH_TOKEN');
        if (empty($token)) {
            // Fallback: parse .env file manually
            $envPath = base_path('.env');
            if (is_file($envPath)) {
                $env = file_get_contents($envPath);
                if (preg_match('/^R4_AUTH_TOKEN=(.+)$/m', $env, $m)) {
                    $token = trim($m[1]);
                }
            }
        }
        if (empty($token)) {
            $token = (string) Str::uuid();
        }
        // Ensure the token is available to the app
        putenv("R4_AUTH_TOKEN={$token}");
        $_ENV['R4_AUTH_TOKEN'] = $token;
        $_SERVER['R4_AUTH_TOKEN'] = $token;
        // APP_URL used for building routes in some responses; not strictly required here
        config()->set('app.url', 'http://localhost');
    }

    public function test_preorder_to_notifica_to_order_approval()
    {
        // Avoid external IP middleware noise and disk writes
        $this->withoutMiddleware(\Softronic\Ipquery\Middleware\IpqueryMiddleware::class);
        Storage::fake('public');
        // 0) Ensure BCV option exists
        Option::updateOrCreate(['clave' => 'BCV'], ['valor' => 115]);

        // 1) Seed a raffle
        $raffle = Raffle::create([
            'cantidad_max' => 10000,
            'nombre' => 'Rifa Test',
            'precio' => 50,
            'fecha_inicial' => now()->toDateString(),
            'fecha_final' => now()->addDays(7)->toDateString(),
        ]);

        // Buyer data (phone must be same across flows)
        $cedula = '18671986';
        $telefonoAfiliado = '04125555555';
        $bankCode = '0102';
        $bank3 = substr($bankCode, -3); // 102
        $cantidad = 2;
        $monto = (string) number_format($raffle->precio * $cantidad, 2, '.', '');

        // 2) Create pre-order via API
        $preResp = $this->post('/api/preOrder', [
            'raffle_id' => $raffle->id,
            'cantidad' => $cantidad,
            'cedula' => $cedula,
            'nombre_completo' => 'Cliente Uno',
            'correo' => 'uno@example.com',
            'telefono' => $telefonoAfiliado,
            'bank_code' => $bankCode,
        ]);
        $preResp->assertStatus(201)->assertJson(['success' => true]);
        $preUuid = $preResp->json('pre_order.uuid');
        $this->assertNotEmpty($preUuid);

        // 3) R4consulta -> true
        $consulta = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => getenv('R4_AUTH_TOKEN'),
        ])->postJson('/api/R4consulta', [
            'IdCliente' => $cedula,
            'TelefonoComercio' => $telefonoAfiliado,
            'Monto' => (float) $monto,
        ]);
        $consulta->assertStatus(200)->assertJson(['status' => true]);

        // 4) R4notifica (code 00) -> true
        // Generate unique reference (8 digits) not used in existing orders
        do {
            $referencia = (string) random_int(10000000, 99999999);
        } while (DB::table('orders')->where('ref_banco', $referencia)->exists());
        $notifica = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => getenv('R4_AUTH_TOKEN'),
        ])->postJson('/api/R4notifica', [
            'IdComercio' => '13536734',
            'TelefonoComercio' => $telefonoAfiliado,
            'TelefonoEmisor' => $telefonoAfiliado,
            'Concepto' => 'PRUEBA',
            'BancoEmisor' => $bank3,
            'Monto' => (float) $monto,
            'FechaHora' => now()->toIso8601String(),
            'Referencia' => $referencia,
            'CodigoRed' => '00'
        ]);
        $notifica->assertStatus(200)->assertJson(['abono' => true]);

        // 5) Reportar pago (crear orden) con la misma data + pre_order_uuid
        $file = UploadedFile::fake()->image('capture.jpg');
        $orderFields = [
            'raffle_id' => $raffle->id,
            'nombre_completo' => 'Cliente Uno',
            'correo' => 'uno@example.com',
            'tlf' => $telefonoAfiliado,
            'cantidad' => $cantidad,
            'cedula' => $cedula,
            'ref_banco' => $referencia,
            'bank_code' => $bankCode,
            'pre_order_uuid' => $preUuid,
        ];
        $orderResp = $this->call('POST', '/api/orderCliente', $orderFields, [], ['ref_imagen' => $file]);
        if ($orderResp->status() !== 201) {
            fwrite(STDERR, "orderCliente response (".$orderResp->status()."): ".$orderResp->getContent()."\n");
            // Dump recent logs to help diagnose
            if (is_file(storage_path('logs/laravel.log'))) {
                $log = file(storage_path('logs/laravel.log'));
                $tail = implode('', array_slice($log, -60));
                fwrite(STDERR, "laravel.log tail:\n".$tail."\n");
            }
        }
        $orderResp->assertStatus(201)->assertJson(['success' => true]);

        // 6) Obtener la orden creada y ejecutar handlers de los Jobs (sin depender de workers)
        $orderId = $orderResp->json('compra.id');
        $this->assertNotEmpty($orderId);

        $order = Order::with('raffle','client')->find($orderId);
        $this->assertNotNull($order);

        // Simular asignación de tickets y aprobación post-tickets
        (new CreateTickets($order))->handle();
        (new ApproveOrderJob($order->id))->handle();

        // 7) Verificar que la orden fue aprobada y la pre-orden pasó a aprobada
        $order->refresh();
        $this->assertEquals('1', $order->estatus, 'La orden no fue aprobada');

        $pre = PreOrder::find($order->pre_order_id);
        $this->assertNotNull($pre);
        $this->assertEquals('aprobada', $pre->estatus_preorden, 'La pre-orden no pasó a aprobada');
        $this->assertTrue((bool) $pre->notificado, 'La pre-orden no quedó notificada');
        $this->assertEquals($referencia, $pre->ref_banco, 'Referencia no coincide en pre-orden');
    }
}
