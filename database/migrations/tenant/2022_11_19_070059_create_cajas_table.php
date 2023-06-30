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
        Schema::create('cajas', function (Blueprint $table) {
            $table->increments("id");
            $table->string("nombre",80);
            $table->tinyInteger("is_default")->default(0);
            $table->enum("estado_caja",["ABIERTA","CERRADA"])->default("CERRADA");
            $table->enum("estado",["ACTIVA","ANULADA"])->default("ACTIVA");
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
        Schema::dropIfExists('cajas');
    }
};
