<?php

use Illuminate\Support\Facades\Route;

Route::get('/', ['uses' => 'HomeController@index', 'as' => 'home']);



