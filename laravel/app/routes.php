<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::post('call', 'CallController@index');
Route::post('call/users', 'CallController@listUsers');
Route::post('call/test', 'CallController@test');
Route::get('/draw', 'DrawController@showDraw');