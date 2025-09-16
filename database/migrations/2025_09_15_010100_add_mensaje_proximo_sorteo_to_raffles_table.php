<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('raffles', function (Blueprint $table) {
            if (! Schema::hasColumn('raffles', 'mensaje_proximo_sorteo')) {
                $table->text('mensaje_proximo_sorteo')->nullable()->after('fecha_final');
            }

            $table->date('fecha_inicial')->nullable()->change();
            $table->date('fecha_final')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('raffles', function (Blueprint $table) {
            if (Schema::hasColumn('raffles', 'mensaje_proximo_sorteo')) {
                $table->dropColumn('mensaje_proximo_sorteo');
            }

            $table->date('fecha_inicial')->nullable(false)->change();
            $table->date('fecha_final')->nullable(false)->change();
        });
    }
};
