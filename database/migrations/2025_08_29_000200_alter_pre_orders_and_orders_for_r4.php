<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pre_orders', function (Blueprint $table) {
            if (!Schema::hasColumn('pre_orders', 'notificado')) {
                $table->boolean('notificado')->default(false)->after('IP');
            }
            if (!Schema::hasColumn('pre_orders', 'notificado_at')) {
                $table->timestamp('notificado_at')->nullable()->after('notificado');
            }
            if (!Schema::hasColumn('pre_orders', 'ref_banco')) {
                $table->char('ref_banco', 8)->nullable()->after('bank_code');
            }
            if (!Schema::hasColumn('pre_orders', 'codigo_red')) {
                $table->char('codigo_red', 2)->nullable()->after('ref_banco');
            }
            if (!Schema::hasColumn('pre_orders', 'fecha_hora')) {
                $table->timestamp('fecha_hora')->nullable()->after('codigo_red');
            }
            if (!Schema::hasColumn('pre_orders', 'monto_notificado')) {
                $table->decimal('monto_notificado', 12, 2)->nullable()->after('monto');
            }
        });

        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'pre_order_id')) {
                $table->unsignedBigInteger('pre_order_id')->nullable()->index();
            }
        });
    }

    public function down(): void
    {
        Schema::table('pre_orders', function (Blueprint $table) {
            if (Schema::hasColumn('pre_orders', 'notificado')) $table->dropColumn('notificado');
            if (Schema::hasColumn('pre_orders', 'notificado_at')) $table->dropColumn('notificado_at');
            if (Schema::hasColumn('pre_orders', 'ref_banco')) $table->dropColumn('ref_banco');
            if (Schema::hasColumn('pre_orders', 'codigo_red')) $table->dropColumn('codigo_red');
            if (Schema::hasColumn('pre_orders', 'fecha_hora')) $table->dropColumn('fecha_hora');
            if (Schema::hasColumn('pre_orders', 'monto_notificado')) $table->dropColumn('monto_notificado');
        });

        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'pre_order_id')) $table->dropColumn('pre_order_id');
        });
    }
};
