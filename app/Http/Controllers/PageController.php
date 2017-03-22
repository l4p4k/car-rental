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

    public function rental()
    {
        $rental = new Rental();
        $data = $rental->db_get_rentals("get");
        return view('rental')->withdata($data);
    }    
}
