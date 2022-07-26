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
        Schema::create('user_ingredients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id');
            $table->integer('energy');
            $table->integer('protein');
            $table->integer('carbohydrate');
            $table->integer('fat');
            $table->boolean('vgn')->default(false);
            $table->boolean('veg')->default(false);
            $table->boolean('gf')->default(false);
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
        Schema::dropIfExists('user_ingredients');
    }
};
