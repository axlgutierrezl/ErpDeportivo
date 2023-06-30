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
        Schema::create('nota_ingreso_detalles', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("nota_ingreso_id");
            $table->unsignedInteger("producto_id");
            $table->decimal("cantidad",18,2);
            $table->decimal("costo",18,4)->default(0);
            $table->decimal("costo_soles",18,4)->default(0);
            $table->decimal("costo_dolares",18,4)->default(0);
            $table->decimal("costo_mas_igv_soles",18,4)->default(0);
            $table->decimal("costo_mas_igv_dolares",18,4)->default(0);
            $table->decimal("valor_ingreso",18,2)->default(0);
            $table->foreign("nota_ingreso_id")->references("id")->on("nota_ingresos")->onDelete("cascade");
            $table->foreign("producto_id")->references("id")->on("productos")->onDelete("cascade");
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
        Schema::dropIfExists('nota_ingreso_detalles');
    }
};
