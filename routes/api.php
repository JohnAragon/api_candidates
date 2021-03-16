<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['prefix' => 'candidate', 'middleware' => 'json_enforce'], function () {
	Route::get('list','Api\CandidateController@index');
	Route::post('store','Api\CandidateController@store');
	Route::post('search','Api\CandidateController@search');
	Route::post('show/{id}','Api\CandidateController@show');
	Route::put('update/{id}','Api\CandidateController@update');
	Route::delete('delete/{id}','Api\CandidateController@destroy');
});
