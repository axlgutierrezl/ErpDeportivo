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
        Schema::create('module_levels', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("module_id");
            $table->string("descripcion",50);
            $table->integer("orden");
            $table->foreign("module_id")->references("id")->on("modules")->onDelete("cascade");
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
        Schema::dropIfExists('module_levels');
    }
};