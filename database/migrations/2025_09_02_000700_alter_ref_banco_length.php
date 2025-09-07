<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Ajustar longitud de referencia a 8 dígitos en ambas tablas (solo para MySQL)
        try {
            $driver = Schema::getConnection()->getDriverName();
            if ($driver === 'mysql') {
                if (Schema::hasTable('orders') && Schema::hasColumn('orders', 'ref_banco')) {
                    DB::statement('ALTER TABLE orders MODIFY ref_banco CHAR(8)');
                }
                if (Schema::hasTable('pre_orders') && Schema::hasColumn('pre_orders', 'ref_banco')) {
                    DB::statement('ALTER TABLE pre_orders MODIFY ref_banco CHAR(8) NULL');
                }
            }
        } catch (\Throwable $e) {
            // ignore on unsupported drivers (e.g., sqlite), schema already correct for tests
        }
    }

    public function down(): void
    {
        // No se conoce el tamaño anterior con certeza; se deja sin revertir para evitar inconsistencias
    }
};
