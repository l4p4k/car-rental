<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use DateTime;

class carRental extends Model
{
    //
    protected $table = "rental";

    public function db_add_rental($user_id, $title, $desc, $make, $model, $type, $fuel, $transmission, $doors){
    	//gets unix timestamp
		$date = new DateTime();
		$time_now = $date->format('Y-m-d H:i:s');

        $query = DB::table('rental')->insert([
            ['rental_id' => "", 'user_id' => $user_id, 'title' => $title, 'description' => $desc, 'make' => $make, 'model' => $model,  'type' => $type,
            'fuel' => $fuel, 'transmission' => $transmission,  'doors' => $doors, 'created_at' => $time_now, 'updated_at' => ""]
        ]);

        return $query;
    }
}
