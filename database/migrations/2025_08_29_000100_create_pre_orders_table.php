<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pre_orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('raffle_id')->index();
            $table->integer('cantidad');
            $table->string('cedula', 32)->index();
            $table->string('nombre_completo', 255);
            $table->string('correo', 255);
            $table->string('telefono', 64);
            $table->char('bank_code', 4)->index();
            $table->decimal('monto', 12, 2)->index();
            $table->string('IP', 64)->nullable();
            $table->timestamps();

            $table->index(['cedula', 'bank_code', 'monto']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pre_orders');
    }
};

