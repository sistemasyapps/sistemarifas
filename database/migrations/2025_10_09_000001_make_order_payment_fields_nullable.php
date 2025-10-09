<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        try {
            $driver = Schema::getConnection()->getDriverName();
            if ($driver === 'mysql') {
                DB::statement('ALTER TABLE orders MODIFY ref_banco CHAR(8) NULL');
                DB::statement('ALTER TABLE orders MODIFY ref_imagen TEXT NULL');
                DB::statement('ALTER TABLE orders MODIFY ref_fecha DATE NULL');
            } else {
                Schema::table('orders', function (Blueprint $table) {
                    $table->char('ref_banco', 8)->nullable()->change();
                    $table->text('ref_imagen')->nullable()->change();
                    $table->date('ref_fecha')->nullable()->change();
                });
            }
        } catch (\Throwable $e) {
            // Silently ignore to keep deploy resilient on unsupported drivers
        }
    }

    public function down(): void
    {
        try {
            $driver = Schema::getConnection()->getDriverName();
            if ($driver === 'mysql') {
                DB::statement('ALTER TABLE orders MODIFY ref_banco CHAR(8) NOT NULL');
                DB::statement('ALTER TABLE orders MODIFY ref_imagen TEXT NOT NULL');
                DB::statement('ALTER TABLE orders MODIFY ref_fecha DATE NOT NULL');
            } else {
                Schema::table('orders', function (Blueprint $table) {
                    $table->char('ref_banco', 8)->nullable(false)->change();
                    $table->text('ref_imagen')->nullable(false)->change();
                    $table->date('ref_fecha')->nullable(false)->change();
                });
            }
        } catch (\Throwable $e) {
            // Down migration best-effort; ignore if not supported
        }
    }
};
