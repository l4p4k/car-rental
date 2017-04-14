<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(my_seeds::class)
        //gets unix timestamp
		$date = new DateTime();
		$time_now = $date->format('Y-m-d H:i:s');

        DB::table('users')->insert([
            'fname'            => "Ebrahim",
            'sname'            => "Ravat",
            'email'            => "eby_146@hotmail.co.uk",
            'password'         => bcrypt('test123')
        ]);

        DB::table('users')->insert([
            'fname'            => "Bob",
            'sname'            => "The Builder",
            'email'            => "eby_123@hotmail.co.uk",
            'password'         => bcrypt('test123')
        ]);  

        $faker = Faker::create('en_GB');
        $num_of_users = 10;
        $num_of_posts = 25;

        foreach (range(1,$num_of_users) as $index) {
            $name = $faker->firstName();
            DB::table('users')->insert([
                'fname'        => $name,
                'sname'        => $faker->lastname(),
                'email'        => $name."@".$faker->domainName,
                'password'     => bcrypt('test123')
            ]);
        }       

        foreach (range(1,$num_of_posts) as $index) {
            DB::table('rental')->insert([
                'user_id'          => $faker->numberBetween(1,$num_of_users),
                'title'            => $faker->word." ".$faker->word,
                'description'      => $faker->paragraph,
                'make'             => $this->randomCarType(),
                'model'            => $faker->word,
                'avail'            => $faker->numberBetween(0,1)
            ]);
        }              
    }

    public function randomCarType(){
        $randomNum = rand(1,15);
        switch ($randomNum) {
            case "1":
                return "Aston Martin";
                break;
            case "2":
                return "Bentley";
                break;
            case "3":
                return "Jaguar";
                break;
            case "4":
                return "Land Rover";
                break;
            case "5":
                return "McLaren";
                break;
            case "6":
                return "Mini";
                break;
            case "7":
                return "Rolls Royce";
                break;
            case "8":
                return "Chevrolet";
                break;
            case "9":
                return "Cadillac";
                break;
            case "10":
                return "Chrystler";
                break;
            case "11":
                return "Dodge";
                break;
            case "12":
                return "Ford";
                break;
            case "13":
                return "GMC";
                break;
            case "14":
                return "Jeep";
                break;
            case "15":
                return "Tesla";
                break;
        }
    }
}
