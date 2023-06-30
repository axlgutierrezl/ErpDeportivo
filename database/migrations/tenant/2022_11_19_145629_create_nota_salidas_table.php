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
        Schema::create('nota_salidas', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedBigInteger("user_id");
            $table->string("numero");
            $table->date("fecha");
            $table->string("origen");
            $table->string("destino");
            $table->text("observacion");
            $table->enum("estado",["ACTIVO","ANULADO"]);
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
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
        Schema::dropIfExists('nota_salidas');
    }
};
