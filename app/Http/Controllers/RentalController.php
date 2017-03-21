<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\carRental as Rental;

use Auth;

class RentalController extends Controller
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

    public function db_add_rental(Request $request)
    {
        $car_rental = new Rental();

        //get authorised user's ID
        $user_id = Auth::user()->id;
        
        $formData = array(
            'title' => $request->input('title'),
            'desc' => $request->input('desc'),
            'make' => $request->input('make'),
            'model' => $request->input('model'),
        );

        $insert = $car_rental->db_add_rental($user_id, $formData['title'], $formData['desc'], $formData['make'],$formData['model']);
        return view('profile');
    }
}
