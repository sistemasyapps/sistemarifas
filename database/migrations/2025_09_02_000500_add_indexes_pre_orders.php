<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Add column for last 3 digits of bank_code to enable efficient indexing
        if (!Schema::hasColumn('pre_orders', 'bank_code_last3')) {
            Schema::table('pre_orders', function (Blueprint $table) {
                $table->char('bank_code_last3', 3)->nullable()->after('bank_code');
            });
            // Backfill existing rows
            DB::statement('UPDATE pre_orders SET bank_code_last3 = RIGHT(bank_code, 3) WHERE bank_code IS NOT NULL AND bank_code <> ""');
        }

        Schema::table('pre_orders', function (Blueprint $table) {
            // For R4consulta matching
            $table->index(['cedula', 'monto', 'created_at'], 'pre_orders_cedula_monto_created_idx');
            // For R4notifica matching by monto + bank last3 + time + notificado
            $table->index(['monto', 'bank_code_last3', 'created_at', 'notificado'], 'pre_orders_monto_bank3_created_notif_idx');
            // Quick lookup by reference
            $table->index('ref_banco', 'pre_orders_ref_banco_idx');
        });
    }

    public function down(): void
    {
        Schema::table('pre_orders', function (Blueprint $table) {
            $table->dropIndex('pre_orders_cedula_monto_created_idx');
            $table->dropIndex('pre_orders_monto_bank3_created_notif_idx');
            $table->dropIndex('pre_orders_ref_banco_idx');
        });

        if (Schema::hasColumn('pre_orders', 'bank_code_last3')) {
            Schema::table('pre_orders', function (Blueprint $table) {
                $table->dropColumn('bank_code_last3');
            });
        }
    }
};
