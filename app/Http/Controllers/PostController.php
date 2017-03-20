<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\post as Post;

use Auth;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function make_post(Request $request)
    {
        $post = new Post();

        //get authorised user's ID
        $user_id = Auth::user()->id;
        
        $formData = array(
            'title' => $request->input('title')
        );

        $insert = $post->newPost($user_id, $formData['title']);
        return view('home');
    }
}
