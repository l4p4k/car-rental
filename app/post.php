<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class post extends Model
{
    //
    protected $table = "posts";

    public function newPost($user_id, $title){
        $query = DB::table('posts')->insert([
            ['post_id' => "", 'user_id' => $user_id, 'title' => $title]
        ]);

        return $query;
    }
}
