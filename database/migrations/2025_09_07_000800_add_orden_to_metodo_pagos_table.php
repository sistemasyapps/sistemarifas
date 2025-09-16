<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('metodo_pagos', function (Blueprint $table) {
            $table->integer('orden')->default(0)->after('tipo');
        });

        DB::table('metodo_pagos')->orderBy('id')->get(['id'])->each(function ($metodo, $index) {
            DB::table('metodo_pagos')->where('id', $metodo->id)->update(['orden' => $index + 1]);
        });
    }

    public function down(): void
    {
        Schema::table('metodo_pagos', function (Blueprint $table) {
            $table->dropColumn('orden');
        });
    }
};
