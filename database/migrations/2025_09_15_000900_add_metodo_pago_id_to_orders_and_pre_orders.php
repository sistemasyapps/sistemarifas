<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (! Schema::hasColumn('orders', 'metodo_pago_id')) {
                $table->bigInteger('metodo_pago_id')->nullable()->after('bank_code');
                $table->foreign('metodo_pago_id')
                    ->references('id')
                    ->on('metodo_pagos')
                    ->nullOnDelete();
            }
        });

        Schema::table('pre_orders', function (Blueprint $table) {
            if (! Schema::hasColumn('pre_orders', 'metodo_pago_id')) {
                $table->bigInteger('metodo_pago_id')->nullable()->after('bank_code');
                $table->foreign('metodo_pago_id')
                    ->references('id')
                    ->on('metodo_pagos')
                    ->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'metodo_pago_id')) {
                $table->dropForeign(['metodo_pago_id']);
                $table->dropColumn('metodo_pago_id');
            }
        });

        Schema::table('pre_orders', function (Blueprint $table) {
            if (Schema::hasColumn('pre_orders', 'metodo_pago_id')) {
                $table->dropForeign(['metodo_pago_id']);
                $table->dropColumn('metodo_pago_id');
            }
        });
    }
};
