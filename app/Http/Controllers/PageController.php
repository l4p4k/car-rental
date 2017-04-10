<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\RentalModel as Rental;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('profile');
    }

    public function index()
    {
        $rental = new Rental();
        $data = $rental->db_get_rentals("page");
        return view('welcome')->withdata($data);
    }

    public function view_new_car()
    {
        return view('new_car');
    }

    public function rental($id)
    {
        $rental = new Rental();
        $rental_data = $rental->db_get_rental_by_id($id);
        $message_data = $rental->db_get_msgs_for_rental($id);
        return view('rental')
        ->with('rental_data', $rental_data)
        ->with('message_data', $message_data);
    }    
}
