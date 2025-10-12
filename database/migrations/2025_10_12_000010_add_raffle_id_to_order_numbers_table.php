<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (! Schema::hasTable('order_numbers') || Schema::hasColumn('order_numbers', 'raffle_id')) {
            return;
        }

        Schema::table('order_numbers', function (Blueprint $table) {
            $table->foreignId('raffle_id')
                ->nullable()
                ->after('order_id')
                ->constrained()
                ->cascadeOnDelete();
        });

        try {
            DB::table('order_numbers')
                ->join('orders', 'orders.id', '=', 'order_numbers.order_id')
                ->update(['order_numbers.raffle_id' => DB::raw('orders.raffle_id')]);
        } catch (\Throwable $e) {
            // Best effort; on unsupported drivers we prefer keeping the column nullable.
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('order_numbers') || ! Schema::hasColumn('order_numbers', 'raffle_id')) {
            return;
        }

        Schema::table('order_numbers', function (Blueprint $table) {
            $table->dropConstrainedForeignId('raffle_id');
        });
    }
};
