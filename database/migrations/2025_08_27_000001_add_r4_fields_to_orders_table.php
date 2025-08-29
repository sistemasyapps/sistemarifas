<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'bank_code')) {
                $table->char('bank_code', 4)->nullable()->index()->after('ref_banco');
            }
            if (!Schema::hasColumn('orders', 'monto_notificado_bs')) {
                $table->decimal('monto_notificado_bs', 12, 2)->nullable()->after('precio_dolar');
            }
            if (!Schema::hasColumn('orders', 'fecha_pago_notificado')) {
                $table->timestamp('fecha_pago_notificado')->nullable()->after('monto_notificado_bs');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'bank_code')) {
                $table->dropColumn('bank_code');
            }
            if (Schema::hasColumn('orders', 'monto_notificado_bs')) {
                $table->dropColumn('monto_notificado_bs');
            }
            if (Schema::hasColumn('orders', 'fecha_pago_notificado')) {
                $table->dropColumn('fecha_pago_notificado');
            }
        });
    }
};

