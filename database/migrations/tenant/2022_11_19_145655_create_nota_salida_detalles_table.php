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
        Schema::create('nota_salida_detalles', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("nota_salida_id");
            $table->unsignedInteger("producto_id");
            $table->decimal("cantidad",18,2);
            $table->text("observacion")->nullable();
            $table->foreign("nota_salida_id")->references("id")->on("nota_salidas")->onDelete("cascade");
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
        Schema::dropIfExists('nota_salida_detalles');
    }
};
