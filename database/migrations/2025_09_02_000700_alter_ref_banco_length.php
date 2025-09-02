<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Ajustar longitud de referencia a 8 dígitos en ambas tablas
        if (Schema::hasTable('orders') && Schema::hasColumn('orders', 'ref_banco')) {
            DB::statement('ALTER TABLE orders MODIFY ref_banco CHAR(8)');
        }

        if (Schema::hasTable('pre_orders')) {
            // En pre_orders la referencia puede ser nullable
            if (Schema::hasColumn('pre_orders', 'ref_banco')) {
                DB::statement('ALTER TABLE pre_orders MODIFY ref_banco CHAR(8) NULL');
            }
        }
    }

    public function down(): void
    {
        // No se conoce el tamaño anterior con certeza; se deja sin revertir para evitar inconsistencias
    }
};

