<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

// My Account
Route::get('/benutzerkonto/adresse', 'MyAccountController@edit')->middleware('auth');
Route::post('/benutzerkonto/adresse', 'MyAccountController@editSave')->middleware('auth');
Route::get('/benutzerkonto/passwort', 'MyAccountController@changepw')->middleware('auth');
Route::post('/benutzerkonto/passwort', 'MyAccountController@changepwSave')->middleware('auth');
