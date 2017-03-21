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
    }
}
