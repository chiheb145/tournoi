<?php

use Illuminate\Support\Facades\Route;

Route::get('/', ['uses' => 'HomeController@index', 'as' => 'home']);




Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/tournois', 'HomeController@index_tournois')->name('tournois.index');
Route::get('/tournois/show/{id}', 'HomeController@show')->name('tournoi.show');
Route::post('/tournoi/store', 'HomeController@store_tournoi')->name('tournoi.store');
Route::post('/tournois/tournoi_delete', 'HomeController@delete_tournoi')->name('tournoi.delete');
Route::post('/tournoi/edit', 'HomeController@edit_tournoi')->name('tournoi.edit');
Route::post('/tournoi/update', 'HomeController@update_tournoi')->name('tournoi.update');

Route::get('/equipes', 'EquipeController@index')->name('equipes.index');
Route::post('/equipe/store', 'EquipeController@store')->name('equipe.store');
Route::post('/equipes/equipe_delete', 'EquipeController@delete_equipe')->name('equipe.delete');
Route::post('/equipe/edit', 'EquipeController@edit')->name('equipe.edit');
Route::post('/equipe/update', 'EquipeController@update')->name('equipe.update');

Route::resource('joueurs', 'JoueurController');
Route::post('/joueur/edit', 'JoueurController@edit_joueur')->name('joueur.edit_joueur');
Route::post('/joueur/update', 'JoueurController@update_joueur')->name('joueur.update');
Route::post('/joueurs/joueur_delete', 'JoueurController@delete_joueur')->name('joueur.delete');
Route::post('/joueurs/attacher_joueur', 'JoueurController@attacher_joueur')->name('joueur.attacher_joueur');
Route::post('/store_attachement', 'JoueurController@store_attachement')->name('joueur.attacher');



Route::resource('antraineurs', 'AntraineurController');



