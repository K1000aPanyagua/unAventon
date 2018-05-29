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

/*RUTAS REGISTRO*/
Route::post('register', 'RegisterController@store'); 

/*RUTAS INCIO DE SESIÓN
Route::post('/login', 'SessionController@store');
Route::get('/logout', 'SessionController');*/
Auth::routes();

Route::get('home', 'HomeController@index')->name('home');
