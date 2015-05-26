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

Route::get('home', 'HomeController@index');

//Route::controllers([
//	'auth' => 'Auth\AuthController',
//	'password' => 'Auth\PasswordController',
//]);

/**************************************************************************
 PHIL'S ROUTES
 *************************************************************************/

Route::get('phil', 'philController@index');


/**************************************************************************
 END PHIL'S ROUTES
 *************************************************************************/


/**************************************************************************
 JOHNSON'S ROUTES
 *************************************************************************/

Route::get('johnson', 'johnsonController@index');


/**************************************************************************
 END JOHNSON'S ROUTES
 *************************************************************************/