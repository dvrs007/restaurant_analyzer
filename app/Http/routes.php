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

/**************************************************************************
 PHIL'S ROUTES
 *************************************************************************/

Route::get('phil', 'philController@index');


/**************************************************************************
 END PHIL'S ROUTES
 *************************************************************************/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::get('about', 'HomeController@about');

//Route::controllers([
//	'auth' => 'Auth\AuthController',
//	'password' => 'Auth\PasswordController',
//]);




Route::get('test2', function(){
    $name = "Hey";
    return("Hello World " . $name);
});
