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

Route::resource('players', 'PlayerController', array('only' => array('store', 'index')));
Route::resource('matches', 'MatchController', array('only' => array('store', 'show', 'update')));

Route::get('/migrate/{key?}',  array(function($key = null)
{
  Artisan::call('migrate', array('--force' => true));
}));
