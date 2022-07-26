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
        Schema::create('recipe_user_ingredient', function (Blueprint $table) {
            $table->foreignId('user_ingredient_id');
            $table->foreignId('recipe_id');
            $table->foreign('user_ingredient_id')->on('user_ingredients')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('recipe_id')->on('recipes')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['user_ingredient_id', 'recipe_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipe_user_ingredient');
    }
};
