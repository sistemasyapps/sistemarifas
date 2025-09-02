<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pre_orders', function (Blueprint $table) {
            if (!Schema::hasColumn('pre_orders', 'estatus_preorden')) {
                $table->string('estatus_preorden', 50)->nullable()->after('codigo_red_texto');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pre_orders', function (Blueprint $table) {
            if (Schema::hasColumn('pre_orders', 'estatus_preorden')) {
                $table->dropColumn('estatus_preorden');
            }
        });
    }
};

