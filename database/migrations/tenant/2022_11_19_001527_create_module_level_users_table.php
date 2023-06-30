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
        Schema::create('module_level_user', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("module_level_id");
            $table->unsignedBigInteger("user_id");
            $table->foreign("module_level_id")->references("id")->on("module_levels")->onDelete("cascade");
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
        Schema::dropIfExists('module_level_user');
    }
};
