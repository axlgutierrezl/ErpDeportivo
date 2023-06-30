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
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedBigInteger("tenant_id");
            $table->string("ruc",11);
            $table->string("razon_social",190);
            $table->string("email",180);
            $table->string("password",180);
            $table->string("plan")->nullable();
            $table->string("perfil")->nullable();
            $table->enum("soap_envio",["Sunat","Ose"]);
            $table->enum("soap_tipo",["Demo","Produccion"]);
            $table->string("soap_password")->nullable();
            $table->string("certificado_pfx")->nullable();
            $table->string("smtp_host")->nullable();
            $table->string("smtp_port")->nullable();
            $table->string("smtp_user")->nullable();
            $table->string("smtp_password")->nullable();
            $table->string("smtp_encrypt")->nullable();
            $table->foreign("tenant_id")->references("id")->on("tenants")->onDelete("cascade");
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
        Schema::dropIfExists('clientes');
    }
};
