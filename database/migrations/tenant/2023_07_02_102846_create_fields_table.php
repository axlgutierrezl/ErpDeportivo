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
        Schema::create('fields', function (Blueprint $table) {
            $table->increments("id");
            $table->string("name");
            $table->string("description")->nullable();
            $table->unsignedInteger("sport_id");
            $table->foreign("sport_id")->references("id")->on("sports")->onDelete("cascade");
            $table->enum("state", ["1", "0"])->default("1");;
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
        Schema::dropIfExists('fields');
    }
};
