<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
            array('id' => '1','first_name' => 'Stefan','last_name' => 'Matzner','email' => 'stefanmatzner@gmx.at','email_verified_at' => NULL,'password' => '$2y$10$cKMFSPGOfrAp1Tl/sSmTVO4fbVyFC5M3bwwd7fcjmYjwd3Pq4T6Dq','remember_token' => NULL,'created_at' => '2022-08-17 11:05:49','updated_at' => '2022-08-19 08:48:45','is_admin' => '1'),
            array('id' => '2','first_name' => 'Max','last_name' => 'Mustermann','email' => 'mustermann@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$vRztkRzM24vZmAREYm4jueA4ZxwmzCFreBFpLz3GSrWpO5mJZD9QG','remember_token' => NULL,'created_at' => '2022-08-18 08:20:05','updated_at' => '2022-08-19 12:54:52','is_admin' => '0'),
            array('id' => '3','first_name' => 'Maria','last_name' => 'Musterfrau','email' => 'musterfrau@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$u93E7DoGvZn8Bsa.TG0uA.Hc6GhcGTcs0EoEThrNs11px1K.9T4s2','remember_token' => NULL,'created_at' => '2022-08-18 14:11:48','updated_at' => '2022-08-18 14:11:48','is_admin' => '0')
          );

        DB::table('users')->insert($users);
    }
}
