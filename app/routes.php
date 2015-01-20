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

Route::post('/migrate/{token?}',  array(function($token = null)
{
  if ($token == $_ENV['MIGRATION_TOKEN']) {
    Artisan::call('migrate', array('--force' => true));
  }
  else
  {
     App::abort(403);
  }
}));

App::before(function($request)
{
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS')
    {
      $statusCode = 204;

      $headers = [
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'GET, POST, PUT, OPTIONS',
        'Access-Control-Allow-Headers' => 'Origin, Content-Type, Accept, Authorization, X-Requested-With',
        'Access-Control-Allow-Credentials' => 'true'
      ];

      return Response::make(null, $statusCode, $headers);
    }
});

App::after(function($request, $response)
{
    $response->headers->set('Access-Control-Allow-Origin', '*');
    $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, OPTIONS');
    $response->headers->set('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization, X-Requested-With');
    $response->headers->set('Access-Control-Allow-Credentials', 'true');

    return $response;
});
