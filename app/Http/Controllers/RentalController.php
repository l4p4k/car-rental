<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input as Input;

use App\RentalModel as Rental;

use Auth;
use Validator;
use URL;
use DB;

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
            'engine' => $request->input('engine'),
            'mpg' => $request->input('mpg'),
            'img' => Input::file('img')
        );

        // Build the validation rules.
        $rules = array(
            'title' => 'required|string|max:50|min:10',
            'desc' => 'required|string|max:255',
            'make' => 'required|string|max:20|min:1',
            'model' => 'required|string|max:30|min:1',
            'type' => 'string|max:20|min:1',
            'fuel' => 'string|max:10|min:1',
            'transmission' => 'string|max:1',
            'doors' => 'string|max:2|min:1',
            'engine' => 'max:9|min:0',
            'mpg' => 'integer|max:100|min:0',
            'img' => 'required|mimes:jpeg,bmp,png|max:20000',
        );

        // Create a new validator instance.
        $validator = Validator::make($formData, $rules);

        //set item_image to 0 as default, meaning the item has no image until validation succeeds
        $item_image = "0";

        // If data is not valid
        if ($validator->fails()) 
        {
            return Redirect::to(URL::previous())->withErrors($validator)->withInput();
        }         

        // If the data passes validation
        if ($validator->passes()) 
        {
            //if image was uploaded
            if (Input::hasFile('img'))
            {
                //check if image is valid
                if (Input::file('img')->isValid()) 
                {
                    //get new item id
                    $new_rental_id = DB::table('rental')->orderBy('rental_id', 'desc')->first()->rental_id + 1;

                    $image_destination = "uploads";
                    $image_extension = "png";
                    $image_new_name = $new_rental_id.".".$image_extension;
                    $file = Input::file('img');
                    $file->move($image_destination, $image_new_name);
                    //image has been uploaded
                    $rental_image = "1";
                }else
                {
                    // sending back with error message.
                    // Session::flash('error', 'uploaded file is not valid');
                    $imageValudation = array(
                        'img' => "uploaded file is not valid",
                    );
                    return Redirect::to(URL::previous())->withErrors($imageValudation)->withInput();
                }
            }

            $car_rental = new Rental();
            $insert = $car_rental->db_add_rental($new_rental_id, $user_id, $formData['title'], $formData['desc'], $formData['make'],$formData['model'], $formData['type'], $formData['fuel'], $formData['transmission'], $formData['doors'], $formData['engine'], $formData['mpg'], $rental_image);
            return redirect()->route('home');
        }
    }

    public function db_add_message(Request $request)
    {
        //get authorised user's ID
        $user_id = Auth::user()->id;

        $formData = array(
            'message_txt' => $request->input('message_txt'),
            'rental_id' => $request->input('rental_id'),
        );

        $rules = array(
            'message_txt' => 'required|string|max:255',
        );

        // Create a new validator instance.
        $validator = Validator::make($formData, $rules);

        // If data is not valid
        if ($validator->fails()) 
        {
            return Redirect::to(URL::previous())->withErrors($validator)->withInput();
        }         

        // If the data passes validation
        if ($validator->passes()) 
        {
            $car_rental = new Rental();
            $insert = $car_rental->db_add_msg($user_id, $formData['rental_id'], $formData['message_txt']);
            return Redirect::to(URL::previous());
        }
    }    
}
