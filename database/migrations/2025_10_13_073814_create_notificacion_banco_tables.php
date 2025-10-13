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
        Schema::create('notificacion_banco', function (Blueprint $table) {
            $table->id(); // bigint unsigned auto-increment
            $table->text('request'); // raw payload enviado por el banco
            $table->unsignedInteger('reintentos')->default(0);
            $table->timestamps();

            $table->index('created_at');
        });

        Schema::create('notificacion_banco_consulta', function (Blueprint $table) {
            $table->id();
            $table->text('request');
            $table->unsignedInteger('reintentos')->default(0);
            $table->timestamps();

            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificacion_banco_consulta');
        Schema::dropIfExists('notificacion_banco');
    }
};
