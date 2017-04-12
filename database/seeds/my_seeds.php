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
            'model'            => "P1",
            'fuel'             => "Hybrid",
            'mpg'              => "36"
        ]);

        DB::table('rental')->insert([
            'rental_id'        => "",
            'user_id'          => "1",
            'title'            => "I'm a baws bruh",
            'description'      => "this stuff is clever af",
            'make'             => "Jeep",
            'model'            => "Poopus",
            'colour'           => "Green",
            'type'             => "4x4/SUV",
            'fuel'             => "Petrol",
            'transmission'     => "1",
            'doors'            => "5",
            'engine_cc'        => "2.2",
            'mpg'              => "30"
        ]);

        DB::table('rental')->insert([
            'rental_id'        => "",
            'user_id'          => "1",
            'title'            => "I want a gud car",
            'description'      => "pls gimmi",
            'make'             => "Mini",
            'model'            => "Cooper S",
            'fuel'             => "Deisel",
            'engine_cc'        => "1.6",
            'mpg'              => "40"
        ]);

    }
}
