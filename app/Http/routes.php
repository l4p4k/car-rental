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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'web'], function () {
    //set xdebug level to 200 for a higher recursive method threshold
    ini_set('xdebug.max_nesting_level', 200);

	Route::auth();

	Route::get('/home', 'PageController@index');

    Route::get('/newpost', [
        'uses' => 'PageController@newpost',
        'as' => 'post.new'
    ]);

});