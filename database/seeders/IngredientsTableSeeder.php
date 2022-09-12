<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

require_once __DIR__.'/../../app/helpers.php';

class IngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ingredients = csvToArray(__DIR__.'/../../resources/uploads/ingredients.csv',';');


        DB::table('ingredients')->insert($ingredients);
    }

    
    
}
