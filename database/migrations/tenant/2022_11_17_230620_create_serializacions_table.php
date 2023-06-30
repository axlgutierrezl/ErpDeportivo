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
        Schema::create('serializacions', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("empresa_id");
            $table->string("tipo_documento_id",5);
            $table->string("serie",10);
            $table->integer("cantidad_numeros");
            $table->string("destino");
            $table->string("por_defecto");
            $table->integer("numero_fin");
            $table->foreign("empresa_id")->references("id")->on("empresas")->onDelete("cascade");
            $table->foreign("tipo_documento_id")->references("id")->on("tipo_documentos")->onDelete("cascade");
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
        Schema::dropIfExists('serializacions');
    }
};
