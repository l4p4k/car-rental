<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\carRental as Rental;

use Auth;
use Validator;
use URL;

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

        //get authorised user's ID
        $user_id = Auth::user()->id;
        
        $formData = array(
            'title' => $request->input('title'),
            'desc' => $request->input('desc'),
            'make' => $request->input('make'),
            'model' => $request->input('model'),
            'type' => $request->input('type'),
            'fuel' => $request->input('fuel'),
            'transmission' => $request->input('transmission'),
            'doors' => $request->input('doors'),
        );

        // Build the validation rules.
        $rules = array(
            'title' => 'required|string|max:50|min:10',
            'desc' => 'string|max:255',
            'make' => 'required|string|max:20|min:1',
            'model' => 'required|string|max:30|min:1',
            'type' => 'required|string|max:20|min:1',
            'fuel' => 'required|string|max:10|min:1',
            'transmission' => 'required|string|max:1',
            'doors' => 'required|string|max:2|min:1',
        );

        // Create a new validator instance.
        $validator = Validator::make($formData, $rules);

        // If data is not valid
        if ($validator->fails()) {
            return Redirect::to(URL::previous())->withErrors($validator)->withInput();
        }         

        // If the data passes validation
        if ($validator->passes()) {
            $car_rental = new Rental();
            $insert = $car_rental->db_add_rental($user_id, $formData['title'], $formData['desc'], $formData['make'],$formData['model'], $formData['type'], $formData['fuel'], $formData['transmission'], $formData['doors']);
            return redirect()->route('profile');
        }
    }
}
