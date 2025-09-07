<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('orders') && Schema::hasColumn('orders', 'emisor_telefono')) {
            Schema::table('orders', function (Blueprint $table) {
                // Index para acelerar matching por teléfono del emisor
                $table->index('emisor_telefono', 'orders_emisor_telefono_index');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('orders')) {
            Schema::table('orders', function (Blueprint $table) {
                try {
                    $table->dropIndex('orders_emisor_telefono_index');
                } catch (\Throwable $e) {
                    // ignore if missing
                }
            });
        }
    }
};

