<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Raffle;
use App\Models\Client;

class R4SeedAndTest extends Command
{
    protected $signature = 'r4:seed-test';

    protected $description = 'Crea datos de prueba para pre_ordenes y ejecuta pruebas básicas de R4consulta/R4notifica';

    public function handle(): int
    {
        $this->info('Sembrando datos de prueba...');

        $raffle = Raffle::first();
        if (!$raffle) {
            $raffle = Raffle::create([
                'cantidad_max' => 10000,
                'nombre' => 'Prueba R4',
                'precio' => 50,
                'fecha_inicial' => now()->toDateString(),
                'fecha_final' => now()->addDays(7)->toDateString(),
                'descripcion' => 'Rifa de prueba',
            ]);
        }

        // Clientes
        $c1 = Client::firstOrCreate(['cedula' => '18671986'], [
            'nombre_completo' => 'Cliente Uno',
            'correo' => 'uno@example.com',
            'telefono' => '04125555555',
        ]);
        $c2 = Client::firstOrCreate(['cedula' => '99999999'], [
            'nombre_completo' => 'Cliente Dos',
            'correo' => 'dos@example.com',
            'telefono' => '04124444444',
        ]);
        $c3 = Client::firstOrCreate(['cedula' => '12345678'], [
            'nombre_completo' => 'Cliente Tres',
            'correo' => 'tres@example.com',
            'telefono' => '04123333333',
        ]);

        // Pre-Orders
        $now = now();
        $pre1 = [
            'uuid' => (string) Str::uuid(),
            'raffle_id' => $raffle->id,
            'cantidad' => 2,
            'cedula' => '18671986',
            'nombre_completo' => 'Cliente Uno',
            'correo' => 'uno@example.com',
            'telefono' => '04125555555',
            'bank_code' => '0102',
            'bank_code_last3' => '102',
            'monto' => 150.00,
            'IP' => '127.0.0.1',
            'created_at' => $now->copy()->subMinutes(10),
            'updated_at' => $now->copy()->subMinutes(10),
        ];

        $pre2 = [
            'uuid' => (string) Str::uuid(),
            'raffle_id' => $raffle->id,
            'cantidad' => 1,
            'cedula' => '99999999',
            'nombre_completo' => 'Cliente Dos',
            'correo' => 'dos@example.com',
            'telefono' => '04124444444',
            'bank_code' => '0134',
            'bank_code_last3' => '134',
            'monto' => 200.50,
            'IP' => '127.0.0.1',
            'created_at' => $now->copy()->subMinutes(8),
            'updated_at' => $now->copy()->subMinutes(8),
        ];

        $pre3 = [
            'uuid' => (string) Str::uuid(),
            'raffle_id' => $raffle->id,
            'cantidad' => 1,
            'cedula' => '12345678',
            'nombre_completo' => 'Cliente Tres',
            'correo' => 'tres@example.com',
            'telefono' => '04123333333',
            'bank_code' => '0191',
            'bank_code_last3' => '191',
            'monto' => 300.00,
            'IP' => '127.0.0.1',
            'created_at' => $now->copy()->subMinutes(6),
            'updated_at' => $now->copy()->subMinutes(6),
        ];

        DB::table('pre_orders')->insert([$pre1, $pre2, $pre3]);

        // Crear Order no aprobada que matchee pre2 por ref y banco
        // Necesita raffle_id, client_id, precio_dolar, cantidad, ref_banco, ref_imagen, ref_fecha, estatus, bank_code
        DB::table('orders')->insert([
            'raffle_id' => $raffle->id,
            'client_id' => $c2->id,
            'precio_dolar' => 40.00,
            'cantidad' => 1,
            'ref_banco' => '87654321',
            'ref_imagen' => 'images/test.jpg',
            'ref_fecha' => now()->toDateString(),
            'estatus' => '0',
            'bank_code' => '0134',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->info('Datos de prueba creados. Ejecuta los curl sugeridos:');
        $auth = env('R4_AUTH_TOKEN');
        $base = config('app.url');
        $this->line("R4consulta (TRUE): curl -s -X POST {$base}/api/R4consulta -H 'Content-Type: application/json' -H 'Authorization: {$auth}' -d '{\"IdCliente\":\"18671986\",\"TelefonoComercio\":\"04125555555\",\"Monto\":150.00}'");
        $this->line("R4notifica pre1 (pendiente_por_orden -> TRUE): curl -s -X POST {$base}/api/R4notifica -H 'Content-Type: application/json' -H 'Authorization: {$auth}' -d '{\"IdComercio\":\"13536734\",\"TelefonoComercio\":\"04125555555\",\"TelefonoEmisor\":\"04146666666\",\"Concepto\":\"PRUEBA\",\"BancoEmisor\":\"102\",\"Monto\":150.00,\"FechaHora\":\"2025-09-02T10:00:00Z\",\"Referencia\":\"12345678\",\"CodigoRed\":\"00\"}'");
        $this->line("R4notifica pre2 (aprobada -> TRUE): curl -s -X POST {$base}/api/R4notifica -H 'Content-Type: application/json' -H 'Authorization: {$auth}' -d '{\"IdComercio\":\"13536734\",\"TelefonoComercio\":\"04125555555\",\"TelefonoEmisor\":\"04147777777\",\"Concepto\":\"PRUEBA\",\"BancoEmisor\":\"134\",\"Monto\":200.50,\"FechaHora\":\"2025-09-02T10:00:00Z\",\"Referencia\":\"87654321\",\"CodigoRed\":\"00\"}'");
        $this->line("R4notifica pre3 (no-00 -> TRUE): curl -s -X POST {$base}/api/R4notifica -H 'Content-Type: application/json' -H 'Authorization: {$auth}' -d '{\"IdComercio\":\"13536734\",\"TelefonoComercio\":\"04125555555\",\"TelefonoEmisor\":\"04148888888\",\"Concepto\":\"PRUEBA\",\"BancoEmisor\":\"191\",\"Monto\":300.00,\"FechaHora\":\"2025-09-02T10:00:00Z\",\"Referencia\":\"22223333\",\"CodigoRed\":\"41\"}'");

        return self::SUCCESS;
    }
}

