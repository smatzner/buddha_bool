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
        Schema::create('ingredient_recipe', function (Blueprint $table) {
            $table->foreignId('ingredient_id');
            $table->foreignId('recipe_id');
            $table->foreign('ingredient_id')->on('ingredients')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('recipe_id')->on('recipes')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['ingredient_id', 'recipe_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredient_recipe');
    }
};
