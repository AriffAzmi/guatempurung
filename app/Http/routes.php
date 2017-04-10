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


Route::post('/api/hash/',"ApiController@testhash");
Route::post('/api/user/register',"ApiController@createUser");
Route::post('/api/user/login',"ApiController@login");
Route::post('/api/user/update',"ApiController@updateUser");
