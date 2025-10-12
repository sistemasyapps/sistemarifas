<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pre_orders', function (Blueprint $table) {
            if (! Schema::hasColumn('pre_orders', 'cliente_cedula')) {
                $table->string('cliente_cedula', 32)
                    ->nullable()
                    ->after('telefono');
                $table->index('cliente_cedula', 'pre_orders_cliente_cedula_idx');
            }
            if (! Schema::hasColumn('pre_orders', 'emisor_cedula')) {
                $table->string('emisor_cedula', 32)
                    ->nullable()
                    ->after('cliente_cedula');
                $table->index('emisor_cedula', 'pre_orders_emisor_cedula_idx');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pre_orders', function (Blueprint $table) {
            if (Schema::hasColumn('pre_orders', 'cliente_cedula')) {
                $table->dropIndex('pre_orders_cliente_cedula_idx');
                $table->dropColumn('cliente_cedula');
            }
            if (Schema::hasColumn('pre_orders', 'emisor_cedula')) {
                $table->dropIndex('pre_orders_emisor_cedula_idx');
                $table->dropColumn('emisor_cedula');
            }
        });
    }
};
