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

    /**
     * add a new rental post
     */
    public function db_add_rental(Request $request)
    {

        //get authorised user's ID
        $user_id = Auth::user()->id;
        
        //place form data into array
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

        // set validation rules.
        $rules = array(
            'title' => 'required|string|max:50|min:10',
            'desc' => 'required|string|max:255|min:20',
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

        // create a new validator instance.
        $validator = Validator::make($formData, $rules);

        //set item_image to 0 as default, meaning the rental has no image until validation succeeds
        $item_image = "0";

        // if data is not valid
        if ($validator->fails()) 
        {
            return $this->display_errors($validator);
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
                    //get new rental id
                    $new_rental_id = DB::table('rental')->orderBy('rental_id', 'desc')->first()->rental_id + 1;

                    //set up image before copying/uploading
                    $image_destination = "uploads";
                    $image_extension = "png";
                    $image_new_name = $new_rental_id.".".$image_extension;
                    $file = Input::file('img');
                    $file->move($image_destination, $image_new_name);
                    //image has been uploaded
                    $rental_image = "1";
                }else
                {
                    //custom validation message
                    $imageValudation = array(
                        'img' => "uploaded file is not valid",
                    );
                    return $this->display_errors($imageValudation);
                }
            }

            //instantiate model
            $car_rental = new Rental();
            //insert new rental post
            $insert = $car_rental->db_add_rental($new_rental_id, $user_id, $formData['title'], $formData['desc'], $formData['make'],$formData['model'], $formData['type'], 
            $formData['fuel'], $formData['transmission'], $formData['doors'], $formData['engine'], $formData['mpg'], $rental_image);
            //return to home view
            return redirect()->route('home');
        }
    }

    /**
     * add a new message
     */
    public function db_add_message(Request $request)
    {
        //get authorised user's ID
        $user_id = Auth::user()->id;

        $formData = array(
            'message_txt' => $request->input('message_txt'),
            'rental_id' => $request->input('rental_id'),
            'file' => Input::file('file')
        );

        $rules = array(
            'message_txt' => 'required|string|max:255',
            'file' => 'max:20000',
        );

        // Create a new validator instance.
        $validator = Validator::make($formData, $rules);

        //set message_file to 0 as default, meaning the rental has no file until validation succeeds
        $message_file = "0";

        if ($validator->fails()) 
        {
            return $this->display_errors($validator);
        } 

        //if file was uploaded check mime type
        if (Input::hasFile('file'))
        {
            //check mime type
            $mime_type = Input::file('file')->getClientMimeType();

            // If data is not valid
            switch($mime_type)
            {
                case "audio/wav":
                    break;
                case "audio/mp3":
                    break;
                case "video/mp4":
                    break;
                case "video/avi":
                    break;
                case "image/jpeg":
                    break;
                case "image/png":
                    break;
                case "image/bmp":
                    break;
                default:
                    //custom validation
                    $fileValudation = array(
                        'file' => "Please upload either image(.png, .jpeg/.jpg or .bmp), audio(.mp3 or .wav) or video(.mp4 or .avi)"
                    );
                    return $this->display_errors($fileValudation);
            }   
        }

        // If the data passes validation
        if ($validator->passes()) 
        {
            //if file was uploaded
            if (Input::hasFile('file'))
            {
                //check if file is valid
                if (Input::file('file')->isValid()) 
                {
                    //get new rental id
                    $new_msg_id = DB::table('message')->where('rental_id', "=", $formData['rental_id'])->orderBy('rental_msg_id', 'desc')->first();
                    //if data is not then increment, otherwise new message id will be 1
                    if($new_msg_id!=null)
                    {
                        $new_msg_id = $new_msg_id->rental_msg_id + 1;
                    }else
                    {
                        $new_msg_id = 1;
                    }

                    //setup file to upload
                    $file = Input::file('file');
                    $file_destination = "uploads";
                    $file_extension = $file->getClientOriginalExtension();

                    $file_new_name = $formData['rental_id'].".".$new_msg_id.".".$file_extension;
                    $file->move($file_destination, $file_new_name);
                    //file has been uploaded
                    $message_file = $file_new_name;
                }else
                {
                    //custom validation message
                    $fileValidation = array(
                        'file' => "uploaded file is not valid"
                    );
                    return $this->display_errors($fileValudation);
                }
            }

            //instantiate model
            $car_rental = new Rental();
            //add new message to rental post
            $insert = $car_rental->db_add_msg($user_id, $formData['rental_id'], $formData['message_txt'], $message_file);
            //return to previous view
            return Redirect::to(URL::previous());
        }
    }

    /**
     * change availability/rent status
     */
    public function rent(Request $request)
    {
        //instantiate model
        $rental = new Rental();
        //get rental post id
        $rental_id = $request->rental_id;
        //get rental post
        $getQuery = $rental::where('rental.rental_id', '=', $rental_id)->first();

        //default value = 0
        $availability = "0";
        // change availability depending on old value from database
        if($getQuery->avail != "1")
        {
            $availability = "1";
        }else
        {
            $availability = "0";
        }
        //update availability
        $rental::where('rental.rental_id', '=', $rental_id)->update(['rental.avail' => $availability]);
        //return back
        return Redirect::to(URL::previous());
    }

    /**
     * display validation errors
     */
    public function display_errors($validator)
    {
        return Redirect::to(URL::previous())->withErrors($validator)->withInput();
    }
}
