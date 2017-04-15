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

    //makes the table accessible through this model
    protected $table = "rental";

    /**
    * gets timestamp
    */
    public function getTime()
    {
        //gets unix timestamp
        $date = new DateTime();
        //format time and date
        $time_now = $date->format('Y-m-d H:i:s');
        //return
        return $time_now;
    }

    /**
    * add a new rental post
    */
    public function db_add_rental($rental_id, $user_id, $title, $desc, $make, $model, $type, $fuel, $transmission, $doors, $engine, $mpg, $rental_image)
    {
        //gets timestamp from function
        $time_now = $this->getTime();

        //inserts into database
        $query = DB::table('rental')->insert([
            ['rental_id' => $rental_id, 'user_id' => $user_id, 'title' => $title, 'description' => $desc, 'make' => $make, 'model' => $model,  'type' => $type,
            'fuel' => $fuel, 'transmission' => $transmission,  'doors' => $doors, 'engine_cc' => $engine, 'mpg' => $mpg, 'img' => $rental_image,
            'created_at' => $time_now, 'updated_at' => ""]
        ]);

        return $query;
    }

    /**
    * get either paginated or full list of rental posts
    */
    public function db_get_rentals($page)
    {
        //if variable is true, return paginated list
        if($page == "page")
        {
            $query = DB::table('users')
                ->join('rental', 'users.id', '=', 'rental.user_id')
                ->select('users.id', 'users.fname', 'users.sname','users.email', 'rental.*')
                ->orderBy('rental.rental_id', 'DESC')
                ->paginate(5);
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

    /**
    * get specific rental post
    */
    public function db_get_rental_by_id($rental_id)
    {
        //get rental post with a certain id
        $query = DB::table('users')
            ->join('rental', 'users.id', '=', 'rental.user_id')
            ->select('users.id', 'users.fname', 'users.sname','users.email', 'rental.*')
            ->where('rental.rental_id', '=', $rental_id)
            ->first();
        return $query;
    }

    /**
    * get rental posts by a certain user
    */
    public function db_get_rentals_by_user($user_id)
    {
        //get rental posts that the user has created
        $query = DB::table('rental')
            ->join('users', 'rental.user_id', '=', 'users.id')
            ->select('users.id', 'users.fname', 'users.sname','users.email', 'rental.*')
            ->where('users.id', '=', $user_id)
            ->get();
        return $query;
    }    

    //messages --------------------------------------------------------------------------------

    /**
    * add a message to the rental post
    */
    public function db_add_msg($user_id, $rental_id, $message_txt, $message_file)
    {
        //gets unix timestamp from function
        $time_now = $this->getTime();

        //get message id of last message within rental post and increment by 1        
        $rental_msg_id = $this->db_last_msg_for_rental($rental_id)+1;

        //insert data into database
        $query = DB::table('message')->insert([
            ['message_id' => "", 
            'rental_msg_id' => $rental_msg_id,  
            'rental_id' => $rental_id, 
            'user_id' => $user_id, 
            'message_txt' => $message_txt,
            'message_file' => $message_file,
            'created_at' => $time_now, 'updated_at' => ""]
        ]);

        return $query;
    }

    /**
    * get messages for that rental post
    */
    public function db_get_msgs_for_rental($rental_id)
    {
        //get all messages where it matches rental post's id
        $query = DB::table('message')
            ->select('message.*', 'message.user_id as messager_id','message.created_at as message_date', 'users.fname','users.sname','users.email', 'rental.rental_id', 'rental.user_id as poster_id', 'rental.title')
            ->join('rental', 'rental.rental_id', '=', 'message.rental_id')
            ->join('users', 'users.id', '=', 'message.user_id')
            ->orderBy('message.message_id', 'DESC')
            ->where('message.rental_id', '=', $rental_id)
            ->paginate(5);
        return $query;
    }

    /**
    * get messages for user
    */
    public function db_get_msgs_for_user($user_id)
    {

        //get nessages that match user's id
        $allMsgsQuery = DB::table('message')
            ->select('message.*', 'message.user_id as messager_id','message.created_at as message_date', 'users.fname','users.sname','users.email', 'rental.rental_id', 'rental.user_id as poster_id', 'rental.title')
            ->join('rental', 'rental.rental_id', '=', 'message.rental_id')
            ->join('users', 'users.id', '=', 'rental.user_id')
            ->orderBy('message.message_id', 'DESC')
            ->where('rental.user_id', '=', $user_id)
            ->paginate(5);
        return $allMsgsQuery;
    }  

    /**
    * count up number of messages user has posted
    */
    public function db_count_msgs_for_user($user_id)
    {
        $allMsgsQuery = DB::table('message')
            ->select('message.*', 'message.user_id as messager_id','message.created_at as message_date', 'users.fname','users.sname','users.email', 'rental.rental_id', 'rental.user_id as poster_id', 'rental.title')
            ->join('rental', 'rental.rental_id', '=', 'message.rental_id')
            ->join('users', 'users.id', '=', 'rental.user_id')
            ->orderBy('message.message_id', 'DESC')
            ->where('rental.user_id', '=', $user_id)
            ->count();
        return $allMsgsQuery;
    }  

    /**
    * 
    */
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
