<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/**
* Routes for the logins
*/
$router->get('/logins', 'LoginController@index');
//$router->get('/logins', 'LoginController@index');
$router->post('/logins', 'LoginController@store');
$router->get('/logins/{login}', 'LoginController@show');
$router->put('/logins/{login}', 'LoginController@update');
$router->patch('/logins/{login}', 'LoginController@update');
$router->delete('/logins/{login}', 'LoginController@destroy');

$router->get('/registers', 'RegisterController@index');
$router->post('/registers', 'RegisterController@store');
$router->get('/registers/{register}', 'RegisterController@show');
$router->put('/registers/{register}', 'RegisterController@update');
$router->patch('/registers/{register}', 'RegisterController@update');
$router->delete('/registers/{register}', 'RegisterController@destroy');

/**
* Routes for the billings
*/
$router->get('/billings', 'BillingController@index');
$router->get('/billings/create', 'BillingController@create');
//Update with POST method
$router->post('billings/{billing}','BillingController@storeupdate');
$router->post('/billings', 'BillingController@store');
$router->get('/billings/{billing}', 'BillingController@show');
$router->put('/billings/{billing}', 'BillingController@update');
$router->patch('/billings/{billing}', 'BillingController@update');
$router->delete('/billings/{billing}', 'BillingController@destroy');

/**
* Routes for the catalogues
*/
$router->get('/catalogues', 'CatalogueController@index');
$router->post('/catalogues', 'CatalogueController@store');
$router->get('/catalogues/{catalogue}', 'CatalogueController@show');

$router->put('/catalogues/{catalogue}', 'CatalogueController@update');
$router->patch('/catalogues/{catalogue}', 'CatalogueController@update');
$router->delete('/catalogues/{catalogue}', 'CatalogueController@destroy');

/**
* Routes for the videos
*/
$router->get('/videos','VideoController@index');
$router->get('/videos/video','VideoController@username');

$router->post('/videos','VideoController@store');
$router->get('/videos/{video}','VideoController@show');
$router->put('/videos/{video}','VideoController@update');
$router->patch('/videos/{video}','VideoController@update');
$router->delete('/videos/{video}','VideoController@destroy');

/**
* Routes for the views
*/
$router->get('/logins1', [
      'as' => 'logins', 'uses' => 'LoginController@views'
]);
$router->get('/registers1', [
      'as' => 'registers', 'uses' => 'RegisterController@views'
]);
$router->get('/billings1', [
      'as' => 'billings', 'uses' => 'BillingController@views'
]);
/**
* Routes for billing that already made
*/
$router->get('/billings1/{billings_exist}', [
      'as' => 'billings_exist', 'uses' => 'BillingController@views_exist'
]);
$router->get('/catalogues1/{catalogue}', [
      'as' => 'catalogues', 'uses' => 'CatalogueController@views'
]);
//Thumbnails
$router->post('/catalogues1/{catalogue}/{thumb}', [
  'as' => 'catalogues_thumb', 'uses' => 'CatalogueController@update_thumb'
]);
$router->get('/videos1/{video}', 'VideoController@views');

$router->get('/{route:.*}/', function ()  {
    return view('app');
});
