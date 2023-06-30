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
        Schema::create('motivo_traslados', function (Blueprint $table) {
            $table->increments("id");
            $table->string("codigo",5);
            $table->string("nombre",100);
            $table->enum("tipo",["INGRESO",'EGRESO']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('motivo_traslados');
    }
};
