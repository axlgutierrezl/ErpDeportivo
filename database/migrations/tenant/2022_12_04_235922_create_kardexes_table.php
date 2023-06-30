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
        Schema::create('kardex', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("documento_id");
            $table->unsignedBigInteger("user_id");
            $table->unsignedInteger("producto_id");
            $table->string("tipo_documento",50);
            $table->string("numero_documento",50);
            $table->date("fecha_documento");
            $table->string("motivo");
            $table->string("tipo",50);
            $table->decimal("precio_costo",18,2);
            $table->decimal("precio_venta",18,2); 
            $table->decimal("cantidad_ingreso",18,2);
            $table->decimal("cantidad_egreso",18,2);
            $table->decimal("saldo",18,2);
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
        Schema::dropIfExists('kardex');
    }
};
