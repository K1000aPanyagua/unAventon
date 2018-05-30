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

Route::resource('card', 'CardController');

Route::resource('car', 'CarController');

<<<<<<< HEAD
Route::resource('auth', 'AuthController');
=======


>>>>>>> e73739c32784ca2d6189c1fa8836d205c7166033
