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

Route::get('/index','WelcomeController@index');

//Route::controllers([
//	'auth' => 'Auth\AuthController',
//	'password' => 'Auth\PasswordController',
//]);

/**************************************************************************
 PHIL'S ROUTES
 *************************************************************************/

Route::get('server-stats', 'philController@index');

Route::get('server-stats-individual', 'philController@server');


/**************************************************************************
 END PHIL'S ROUTES
 *************************************************************************/

/**************************************************************************
 JS'S ROUTES
 *************************************************************************/
//Menus----------------------------------------
Route::get('menus', 'MenuController@index');

//CREATE
Route::get('menus/create','MenuController@create');
//STORE
Route::post('menus','MenuController@store');

//SHOW
Route::get('menus/{id}','MenuController@show');

//EDIT
Route::get('menus/{id}/edit','MenuController@edit');
//UPDATE(store edited one)
Route::post('menusUpdate', 'MenuController@update');

//Delete
Route::post('menuDelete','MenuController@deleteButton');
Route::get('menus/{id}/delete', 'MenuController@deleteLink');
//Orders----------------------------------------
Route::get('orders', 'OrderController@index');


//CREATE(INSERT)://capture post request from OrderController
Route::get('orders/create', 'OrderController@create');
//STORE
Route::post('orders','OrderController@store');


//ADD ITEM(S)
Route::get('orders/{id}/chooseItem','OrderController@chooseItem');
//INSERT ITEMs into lineitems table
Route::post('AddLineItems', 'OrderController@itemStore');


//Ver.2. Add items: items.blade.php
Route::get('orders/{id}/items','OrderController@addItems');
Route::post('itemsAdd','OrderController@itemsAdd');


//SHOW
Route::get('orders/{id}','OrderController@show');

//Route::get('orders/choose','OrderController@choose');
//Route::post('orders','OrderController@itemStore');


//Analysis-------------------------------------
Route::get('totalSales', 'jeesooController@index');
//Route::get('jeesoo/ex','jeesooController@example');  //view page: chartExample

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
