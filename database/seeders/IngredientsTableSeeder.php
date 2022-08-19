<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ingredients = array(
            array('id' => '1','category_id' => '1','title' => 'Blattspinat','energy' => '23','protein' => '3','carbohydrate' => '4','fat' => '0','vgn' => '1','veg' => '1','gf' => '1','created_at' => '2022-08-17 08:35:24','updated_at' => '2022-08-17 08:35:24'),
            array('id' => '2','category_id' => '2','title' => 'Brokkoli','energy' => '34','protein' => '3','carbohydrate' => '7','fat' => '0','vgn' => '1','veg' => '1','gf' => '1','created_at' => '2022-08-17 08:36:17','updated_at' => '2022-08-17 11:09:07'),
            array('id' => '3','category_id' => '3','title' => 'Süßkartoffel','energy' => '86','protein' => '2','carbohydrate' => '20','fat' => '0','vgn' => '1','veg' => '1','gf' => '1','created_at' => '2022-08-17 08:37:56','updated_at' => '2022-08-17 08:37:56'),
            array('id' => '4','category_id' => '4','title' => 'Hühnerbrust','energy' => '263','protein' => '15','carbohydrate' => '15','fat' => '16','vgn' => '0','veg' => '0','gf' => '1','created_at' => '2022-08-17 08:38:49','updated_at' => '2022-08-17 08:38:49'),
            array('id' => '5','category_id' => '5','title' => 'Avocado','energy' => '167','protein' => '2','carbohydrate' => '9','fat' => '15','vgn' => '1','veg' => '1','gf' => '1','created_at' => '2022-08-17 08:39:27','updated_at' => '2022-08-17 08:39:27'),
            array('id' => '6','category_id' => '6','title' => 'Heidelbeeren','energy' => '57','protein' => '1','carbohydrate' => '15','fat' => '0','vgn' => '1','veg' => '1','gf' => '1','created_at' => '2022-08-17 08:40:13','updated_at' => '2022-08-17 11:09:00'),
            array('id' => '7','category_id' => '7','title' => 'Hummus','energy' => '177','protein' => '5','carbohydrate' => '20','fat' => '9','vgn' => '1','veg' => '1','gf' => '1','created_at' => '2022-08-17 08:41:07','updated_at' => '2022-08-18 15:48:04')
          );

        DB::table('ingredients')->insert($ingredients);
    }
    
}
