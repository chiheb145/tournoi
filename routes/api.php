<?php

use Illuminate\Http\Request;


Route::post('login', 'Api\AuthController@login');
Route::post('/logout', 'Api\AuthController@logout');


Route::group(['middleware' => 'auth:api'], function() {

    Route::get('/tournois', 'Api/ApiTournoiController@index_tournois');






});
