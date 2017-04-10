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
        if($page == "page")
        {
            $query = DB::table('users')
                ->join('rental', 'users.id', '=', 'rental.user_id')
                ->select('users.id', 'users.fname', 'users.sname','users.email', 'rental.*')
                ->orderBy('rental.rental_id', 'DESC')
                ->paginate(3);
            return $query;
        }else
        {
            $query = DB::table('users')
                ->join('rental', 'users.id', '=', 'rental.user_id')
                ->select('users.id', 'users.fname', 'users.sname','users.email', 'rental.*')
                ->orderBy('rental.rental_id', 'DESC')
                ->get();
            return $query;
        }
    }

    public function db_get_rental_by_id($id)
    {
        $query = DB::table('users')
            ->join('rental', 'users.id', '=', 'rental.user_id')
            ->select('users.id', 'users.fname', 'users.sname','users.email', 'rental.*')
            ->where('rental.rental_id', '=', $id)
            ->first();
        return $query;
    }

    //messages

    public function db_add_msg($user_id, $rental_id, $message_txt)
    {
        //gets unix timestamp
        $date = new DateTime();
        $time_now = $date->format('Y-m-d H:i:s');
        $rental_msg_id = $this->db_last_msg_for_rental($rental_id)+1;

        $query = DB::table('message')->insert([
            ['message_id' => "", 
            'rental_msg_id' => $rental_msg_id,  
            'rental_id' => $rental_id, 
            'user_id' => $user_id, 
            'message_txt' => $message_txt,
            'created_at' => $time_now, 'updated_at' => ""]
        ]);

        return $query;
    }

    public function db_get_msgs_for_rental($rental_id)
    {
        $query = DB::table('message')
            ->select('message.*', 'users.fname','users.sname','users.email', 'rental.*')
            ->join('rental', 'rental.rental_id', '=', 'message.rental_id')
            ->join('users', 'users.id', '=', 'rental.user_id')
            ->orderBy('message.message_id', 'DESC')
            ->where('message.rental_id', '=', $rental_id)
            ->get();
        return $query;
    }    

    public function db_last_msg_for_rental($rental_id)
    {
        $query = DB::table('message')
            ->select('message.*', 'users.fname','users.sname','users.email', 'rental.*')
            ->join('rental', 'rental.rental_id', '=', 'message.rental_id')
            ->join('users', 'users.id', '=', 'rental.user_id')
            ->orderBy('message.message_id', 'DESC')
            ->where('message.rental_id', '=', $rental_id)
            ->first();
            if($query == null)
            {
                return '0';
            }else
            {
                return $query->rental_msg_id;
            }
    }
}
