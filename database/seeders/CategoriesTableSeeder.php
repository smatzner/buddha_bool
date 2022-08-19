<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = array(
            array('id' => '1','title' => 'Salatbasis'),
            array('id' => '2','title' => 'Gemüse'),
            array('id' => '3','title' => 'Kohlenhydrate'),
            array('id' => '4','title' => 'Proteine'),
            array('id' => '5','title' => 'Fette'),
            array('id' => '6','title' => 'Früchte'),
            array('id' => '7','title' => 'Topping')
          );

        DB::table('categories')->insert($categories);
    }
}
