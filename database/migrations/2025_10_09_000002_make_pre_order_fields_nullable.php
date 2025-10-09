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
                DB::statement('ALTER TABLE pre_orders MODIFY telefono VARCHAR(64) NULL');
                DB::statement('ALTER TABLE pre_orders MODIFY bank_code CHAR(4) NULL');
            } else {
                Schema::table('pre_orders', function (Blueprint $table) {
                    $table->string('telefono', 64)->nullable()->change();
                    $table->char('bank_code', 4)->nullable()->change();
                });
            }
        } catch (\Throwable $e) {
            // Ignore when database driver cannot alter columns directly
        }
    }

    public function down(): void
    {
        try {
            $driver = Schema::getConnection()->getDriverName();
            if ($driver === 'mysql') {
                DB::statement('ALTER TABLE pre_orders MODIFY telefono VARCHAR(64) NOT NULL');
                DB::statement('ALTER TABLE pre_orders MODIFY bank_code CHAR(4) NOT NULL');
            } else {
                Schema::table('pre_orders', function (Blueprint $table) {
                    $table->string('telefono', 64)->nullable(false)->change();
                    $table->char('bank_code', 4)->nullable(false)->change();
                });
            }
        } catch (\Throwable $e) {
            // Best effort down migration
        }
    }
};
