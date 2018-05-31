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
<<<<<<< HEAD
Route::get('/register', 'Auth\RegisterController@getRegister');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/login', 'Auth\LoginController@getLogin');
Route::post('/login', 'Auth\LoginController@postLogin');

Route::get('/logout', 'Auth\LoginController@logOut');
=======
<<<<<<< HEAD
Route::resource('auth', 'AuthController');
=======
>>>>>>> cc18c37abbc7378a6ed6142f48ef393fd0739ccf


>>>>>>> e73739c32784ca2d6189c1fa8836d205c7166033
>>>>>>> 3500a9d6b9fd85a0b4815a619fd4dd60dcb2dbf0
