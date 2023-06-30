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
        Schema::create('tabla_detalles', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("tabla_id");
            $table->string("descripcion");
            $table->string("nombre")->nullable();
            $table->string("simbolo")->nullable();
            $table->string("parametro")->nullable();
            $table->string("operacion")->nullable();
            $table->string("tipo")->nullable();
            $table->boolean("editable")->default(0);
            $table->enum("estado",["ACTIVO","ANULADO"]);
            $table->foreign("tabla_id")->references("id")->on("tablas")->onDelete("cascade");
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
        Schema::dropIfExists('tabla_detalles');
    }
};
