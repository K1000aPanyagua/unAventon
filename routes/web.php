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

Route::pattern('users', '[0-9]+');
Route::delete('/cancel/{ride}', 'UserController@cancelSolicitude')
		->name('user.cancelSolicitude');
Route::get('/postulate/{ride}', 'UserController@postulate')
		->name('user.postulate');
Route::resource('user', 'UserController');
Route::get('/editPass', 'UserController@editPassword');
Route::post('/newPass', 'UserController@updatePassword');



Route::resource('card', 'CardController');
Route::post('/eliminate', 'CarController@eliminate');
Route::get('/list', 'CarController@list');
Route::resource('car', 'CarController');

Route::get('/register', 'Auth\RegisterController@getRegister');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/login', 'Auth\LoginController@getLogin');
Route::post('/login', 'Auth\LoginController@postLogin');
Route::post('/postRecover', 'Auth\LoginController@recoverAccount');
Route::get('/logout', 'Auth\LoginController@logOut');
Route::get('/getRecover', 'Auth\LoginController@getLogInDeleted');

Route::get('/resetPassword', 'Auth\ForgotPasswordController@reset');



Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/new', 'Auth\ForgotPasswordController@sendResetLinkEmail');

Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


Route::resource('ride', 'RideController');
Route::resource('auth', 'AuthController');

Route::get('/result', 'RideController@getBy');


Route::resource('comment', 'CommentController');
