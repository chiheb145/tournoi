<?php

use Illuminate\Support\Facades\Route;

Route::get('/', ['uses' => 'HomeController@index', 'as' => 'home']);




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
