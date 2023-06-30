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
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments("id");
            $table->string("ruc",11);
            $table->string("razon_social",190);
            $table->string("razon_social_abreviada",190)->nullable();
            $table->string("ruta_logo",190)->nullable();
            $table->string("direccion_fiscal",190);
            $table->string("ubigeo",10);
            $table->string("telefono",20)->nullable();
            $table->string("celular",11)->nullable();
            $table->string("mail_mailer",10);
            $table->string("mail_host",20);
            $table->string("mail_port",5);
            $table->string("mail_username",80);
            $table->string("mail_password",256);
            $table->string("mail_encryption",5);
            $table->string("facebook",100)->nullable();
            $table->string("instagram",100)->nullable();
            $table->string("web",100)->nullable();
            $table->enum("soap_envio",["Sunat","Ose"]);
            $table->enum("soap_tipo",["Demo","Produccion"]);
            $table->string("soap_password")->nullable();
            $table->string("certificado_pfx")->nullable();
            $table->enum("estado",['ACTIVO','ANULADO'])->default('ACTIVO');
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
        Schema::dropIfExists('empresas');
    }
};
