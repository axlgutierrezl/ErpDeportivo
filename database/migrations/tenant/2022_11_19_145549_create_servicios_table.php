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
        Schema::create('servicios', function (Blueprint $table) {
            $table->increments("id");
            $table->string("nombre");
            $table->decimal("precio",18,2);
            $table->enum("estado_alquiler",["CAMPO NOCHE","CAMPO DIA",'ACADEMIA']);
            $table->enum("estado",["ACTIVO","ANULADO"]);
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
        Schema::dropIfExists('servicios');
    }
};
