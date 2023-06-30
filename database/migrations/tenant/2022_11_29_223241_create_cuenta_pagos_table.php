<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuenta_pagos', function (Blueprint $table) {
            $table->increments("id");
            $table->date("fecha_pago");
            $table->dateTime("fecha_pago_real");
            $table->string("metodo_pago");
            $table->boolean("tiene_tarjeta");
            $table->string("tipo_tarjeta");
            $table->string("numero_operacion");
            $table->decimal("pago",18,2);
            $table->boolean("estado")->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuenta_pagos');
    }
};
