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
        Schema::create('empresa_facturacions', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("empresa_id");
            $table->string("ruta_certificado_pfx",256)->nullable();
            $table->string("nombre_certificado_pfx",180)->nullable();
            $table->text("password_certificado_pfx")->nullable();
            $table->string("sol_user",80)->nullable();
            $table->string("sol_password",90)->nullable();
            $table->string("plan",20)->nullable();
            $table->string("ambiente",20)->nullable();
            $table->string("ruta_certificado_pem",190)->nullable();
            $table->text("certificado")->nullable();
            $table->text("token")->nullable();
            $table->enum("estado",["ACTIVO","ANULADO"])->default("ACTIVO");
            $table->foreign("empresa_id")->references("id")->on("empresas")->onDelete("cascade");
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
        Schema::dropIfExists('empresa_facturacions');
    }
};
