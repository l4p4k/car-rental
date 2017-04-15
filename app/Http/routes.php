<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


// Route::group(['middleware' => 'web'], function () {
    //set xdebug level to 200 for a higher recursive method threshold
    ini_set('xdebug.max_nesting_level', 200);

    //gets auth middleware
	Route::auth();

    //profile dashboard page route
    Route::get('/profile', [
        'uses' => 'PageController@profile',
        'as' => 'profile'
    ]);

    //welcome page route
    Route::get('/', [
        'uses' => 'PageController@index',
        'as' => 'home'
    ]);

    //second welcome page route for routing from /home to /
    Route::get('/home', [
        'uses' => 'PageController@index'
    ]);    

    //new rental post page route
    Route::get('/new_rental', [
        'uses' => 'PageController@view_new_car',
        'as' => 'rental.page'
    ]);

    //form post for new rental post route
    Route::post('/add_car', [
        'uses' => 'RentalController@db_add_rental',
        'as' => 'rental.form'
    ]); 

    //rental information page route
    Route::get('/rental/{id}', [
        'uses' => 'PageController@rental',
        'as' => 'rental.details',
        function ($id = '1') {
    }]);

    //form post for new message route
    Route::post('/new_message', [
        'uses' => 'RentalController@db_add_message',
        'as' => 'message.form'
    ]); 

    //list of messages page route
    Route::get('/messages', [
        'uses' => 'PageController@messages',
        'as' => 'message.page'
    ]);  

    //form post for updating availability of rental post route
   Route::post('/change_rent', [
        'uses' => 'RentalController@rent',
        'as' => 'rental.rent'
    ]);       
// });