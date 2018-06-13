<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','PagesController@getIndex');
Route::get('/search','PagesController@getSearch');
Route::get('/configurationAccount','PagesController@getAccount');
Route::get('/resultregister','PagesController@getResultRegister');

Route::resource('user', 'UserController');
Route::get('/editPass', 'UserController@editPassword');

Route::resource('card', 'CardController');

Route::get('/list', 'CarController@list');
Route::resource('car', 'CarController');

Route::get('/register', 'Auth\RegisterController@getRegister');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/login', 'Auth\LoginController@getLogin');
Route::post('/login', 'Auth\LoginController@postLogin');
Route::post('/postRecover', 'Auth\LoginController@recoverAccount');
Route::get('/logout', 'Auth\LoginController@logOut');
Route::get('/getRecover', 'Auth\LoginController@getLogInDeleted');

Route::resource('auth', 'AuthController');

Route::resource('ride', 'RideController');

