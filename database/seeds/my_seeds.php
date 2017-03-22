<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class my_seeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//gets unix timestamp
		$date = new DateTime();
		$time_now = $date->format('Y-m-d H:i:s');

        DB::table('users')->insert([
            'fname'            => "Ebrahim",
            'sname'            => "Ravat",
            'phone'            => "",
            'email'            => "eby_146@hotmail.co.uk",
            'password'         => bcrypt('poop123'),
            'role'            => "user"
        ]);

        DB::table('rental')->insert([
            'rental_id'        => "",
            'user_id'          => "1",
            'title'            => "Wanting Jaguar",
            'description'      => "filler",
            'make'             => "Jaguar",
            'model'            => "Kat"
        ]);

        DB::table('rental')->insert([
            'rental_id'        => "",
            'user_id'          => "1",
            'title'            => "P1 cleaner than your church shoes",
            'description'      => "I'm just tryna put you in the worst mood",
            'make'             => "Mclaren",
            'model'            => "P1"
        ]);

        DB::table('rental')->insert([
            'rental_id'        => "",
            'user_id'          => "1",
            'title'            => "I'm a baws bruh",
            'description'      => "this stuff is clever af",
            'make'             => "Jeep",
            'model'            => "Poopus"
        ]);

        DB::table('rental')->insert([
            'rental_id'        => "",
            'user_id'          => "1",
            'title'            => "I want a gud car",
            'description'      => "pls gimmi",
            'make'             => "Mini",
            'model'            => "Cooper S"
        ]);

    }
}
