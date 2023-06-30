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
        Schema::create('productos', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("almacen_id");
            $table->unsignedInteger("categoria_id");
            $table->unsignedInteger("marca_id");
            $table->string("nombre");
            $table->string("descripcion")->nullable();
            $table->string("codigo_barra",20)->nullable();
            $table->decimal("precio_venta",18,2);
            $table->decimal("precio_compra",18,2);
            $table->decimal("stock",18,2);
            $table->boolean("tiene_igv");
            $table->decimal("stock_minimo",18,2);
            $table->string("unidad_medida",5);
            $table->enum("estado",['ACTIVO','ANULADO']);
            $table->foreign("almacen_id")->references("id")->on("almacenes")->onDelete("cascade");
            $table->foreign("categoria_id")->references("id")->on("categorias")->onDelete("cascade");
            $table->foreign("marca_id")->references("id")->on("marcas")->onDelete("cascade");
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
        Schema::dropIfExists('productos');
    }
};
