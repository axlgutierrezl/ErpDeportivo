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
        Schema::create('cliente_pagos', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("client_id");
            $table->unsignedInteger("tipo_metodo_pago_id");
            $table->unsignedInteger("tarjeta_marca_id");
            $table->date("fecha_pago");
            $table->boolean("tiene_tarjeta");
            $table->string("referencia",180);
            $table->decimal("monto",18,2);
            $table->boolean("estado")->default(1);
            $table->foreign("client_id")->references("id")->on("clientes")->onDelete("cascade");
            $table->foreign("tipo_metodo_pago_id")->references("id")->on("tipo_metodo_pagos")->onDelete("cascade");
            $table->foreign("tarjeta_marca_id")->references("id")->on("tarjeta_marcas")->onDelete("cascade");
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
        Schema::dropIfExists('cliente_pagos');
    }
};
