<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pre_orders', function (Blueprint $table) {
            if (!Schema::hasColumn('pre_orders', 'codigo_red_texto')) {
                $table->string('codigo_red_texto', 100)->nullable()->after('codigo_red');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pre_orders', function (Blueprint $table) {
            if (Schema::hasColumn('pre_orders', 'codigo_red_texto')) {
                $table->dropColumn('codigo_red_texto');
            }
        });
    }
};

