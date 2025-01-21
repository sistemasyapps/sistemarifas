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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId("raffle_id")->constrained();
            $table->foreignId("client_id")->constrained();
            $table->decimal("precio_dolar",total: 6, places: 2);
            $table->integer("cantidad");
            $table->char("ref_banco",length: 8)->unique();
            $table->text("ref_imagen");
            $table->date("ref_fecha");
            $table->char("estatus",length: 1)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
