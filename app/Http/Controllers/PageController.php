<?php

namespace App\Http\Controllers;

use App\RentalModel as Rental;
use App\Http\Requests;

use Illuminate\Http\Request;

use Auth;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'rental']]);
    }

    /**
     * Show the profile dashboard.
     */
    public function profile()
    {
        return view('profile');
    }

    /**
     * Show the welcome page.
     */
    public function index()
    {
        //instantiate model
        $rental = new Rental();
        //get all rental posts
        $rental_data = $rental->db_get_rentals("page");

        //show welcome page with data
        return view('welcome')
        ->with('rental_data', $rental_data);
    }

    /**
     * Show the page to create a new car rental page.
     */
    public function new_rental()
    {
        //show new car page with data
        return view('new_car');
    }

    /**
     * Show the view a specific rental page.
     */
    public function rental($id)
    {
        //instantiate model
        $rental = new Rental();
        //get rental information and messages for that post
        $rental_data = $rental->db_get_rental_by_id($id);
        $message_data = $rental->db_get_msgs_for_rental($id);

        //show rental page with data
        return view('rental')
        ->with('rental_data', $rental_data)
        ->with('message_data', $message_data);
    }    

    /**
     * Show messages by the user.
     */
    public function messages()
    {
        //instantiate model
        $rental = new Rental();
        //get messages the user has sent and the number of messages
        $message_data = $rental->db_get_msgs_for_user(Auth::user()->id);
        $count = $rental->db_count_msgs_for_user(Auth::user()->id);

        //show messages page with data
        return view('messages')
        ->with('message_data', $message_data)
        ->with('count', $count);
    }
}
