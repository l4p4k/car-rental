<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use DateTime;

class RentalModel extends Model

{   
    public function user(){
        return $this->belongsTo('App\User');
    }

    //
    protected $table = "rental";

    public function db_add_rental($user_id, $title, $desc, $make, $model, $type, $fuel, $transmission, $doors, $engine, $mpg)
    {
    	//gets unix timestamp
		$date = new DateTime();
		$time_now = $date->format('Y-m-d H:i:s');

        $query = DB::table('rental')->insert([
            ['rental_id' => "", 'user_id' => $user_id, 'title' => $title, 'description' => $desc, 'make' => $make, 'model' => $model,  'type' => $type,
            'fuel' => $fuel, 'transmission' => $transmission,  'doors' => $doors, 'engine_cc' => $engine, 'mpg' => $mpg, 
            'created_at' => $time_now, 'updated_at' => ""]
        ]);

        return $query;
    }

    public function db_get_rentals($page)
    {
        if($page == "page"){
            $query = DB::table('users')
                ->join('rental', 'users.id', '=', 'rental.user_id')
                ->select('users.id', 'users.fname', 'users.sname','users.email', 'rental.*')
                ->orderBy('rental.rental_id', 'DESC')
                ->paginate(3);
            return $query;
        }else{
            $query = DB::table('users')
                ->join('rental', 'users.id', '=', 'rental.user_id')
                ->select('users.id', 'users.fname', 'users.sname','users.email', 'rental.*')
                ->orderBy('rental.rental_id', 'DESC')
                ->get();
            return $query;
        }

    }
}
