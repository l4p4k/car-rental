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

	Route::auth();

    Route::get('/profile', [
        'uses' => 'PageController@profile',
        'as' => 'profile'
    ]);

    Route::get('/', [
        'uses' => 'PageController@index',
        'as' => 'home'
    ]);

    Route::get('/home', [
        'uses' => 'PageController@index'
    ]);    

    Route::get('/new_rental', [
        'uses' => 'PageController@view_new_car',
        'as' => 'rental.page'
    ]);

    Route::post('/add_car', [
        'uses' => 'RentalController@db_add_rental',
        'as' => 'rental.form'
    ]); 

    Route::get('/rental/{id}', [
        'uses' => 'PageController@rental',
        'as' => 'rental.details',
        function ($id = '1') {
    }]);

    Route::post('/new_message', [
        'uses' => 'RentalController@db_add_message',
        'as' => 'message.form'
    ]); 

    Route::get('/messages', [
        'uses' => 'PageController@messages',
        'as' => 'message.page'
    ]);  

   Route::post('/rent', [
        'uses' => 'RentalController@rent',
        'as' => 'rent'
    ]);       
// });