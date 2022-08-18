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
        Schema::create('ingredient_user_ingredient', function (Blueprint $table) {
            $table->foreignId('ingredient_id');
            $table->foreignId('user_ingredient_id');

            $table->foreign('ingredient_id')->on('ingredients')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_ingredient_id')->on('user_ingredients')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['ingredient_id', 'user_ingredient_id'],'ingredient_user_ingredient_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredient_user_ingredient');
    }
};
