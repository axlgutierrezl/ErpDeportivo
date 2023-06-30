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
        Schema::create('nota_ingresos', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedBigInteger("user_id");
            $table->unsignedInteger("motivo_traslado_id");
            $table->string("numero");
            $table->date("fecha");
            $table->string("origen");
            $table->string("destino");
            $table->string("moneda");
            $table->decimal("tipo_cambio",18,2)->default(0);
            $table->decimal("dolar",18,4)->default(0);
            $table->decimal("total",18,2)->default(0);
            $table->decimal("total_soles",18,4)->default(0);
            $table->decimal("total_dolares",18,4)->default(0);
            $table->decimal("total_mas_igv_soles",18,4)->default(0);
            $table->decimal("total_mas_igv_dolares",18,4)->default(0);
            $table->text("observacion")->nullable();
            $table->enum("estado",["ACTIVO","ANULADO"])->default("ACTIVO");
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("motivo_traslado_id")->references("id")->on("motivo_traslados")->onDelete("cascade");
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
        Schema::dropIfExists('nota_ingresos');
    }
};
