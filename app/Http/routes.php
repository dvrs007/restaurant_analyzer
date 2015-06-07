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

Route::get('/', 'WelcomeController@index');

Route::get('stats/Stats_index', 'statsController@Stats_index');

//Route::controllers([
//	'auth' => 'Auth\AuthController',
//	'password' => 'Auth\PasswordController',
//]);

/**************************************************************************
 PHIL'S ROUTES
 *************************************************************************/

Route::get('server-stats', 'philController@index');


/**************************************************************************
 END PHIL'S ROUTES
 *************************************************************************/

/**************************************************************************
 JS'S ROUTES
 *************************************************************************/
//Menus
Route::get('menus', 'MenuController@index');

//Orders
Route::get('orders', 'OrderController@index');


//CREATE(INSERT)://capture post request from OrderController
Route::get('orders/create', 'OrderController@create');
//STORE
Route::post('orders','OrderController@store');

//SHOW
Route::get('orders/{id}','OrderController@show');

//ADD ITEM(S)
Route::get('orders/{id}/items','OrderController@item');

//INSERT ITEMs/UPDATE orders table
Route::post('itemsUpdate', 'OrderController@update');

//Route::get('orders/choose','OrderController@choose');
//Route::post('orders','OrderController@itemStore');


//Analysis
Route::get('jeesoo', 'jeesooController@index');
Route::get('jeesoo/ex','jeesooController@example');
Route::get('jeesoo/analysis', 'jeesooController@totalSales');

/**************************************************************************
 END JS'S ROUTES
 *************************************************************************/

Route::get('/', 'WelcomeController@index');

/**************************************************************************
 JOHNSON'S ROUTES
 *************************************************************************/

Route::get('item-sales', 'johnsonController@index');


/**************************************************************************
 END JOHNSON'S ROUTES
 *************************************************************************/
