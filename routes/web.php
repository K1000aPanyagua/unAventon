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

Route::get('/showPassengers/{idRide}', 'PagesController@showPassengers')
		->name('page.showPassengers');


Route::pattern('users', '[0-9]+');
Route::get('/decline/{idRide}/{idPostulant}', 'UserController@declineSolicitude')
		->name('user.declineSolicitude');
Route::get('/accept/{idRidede}/{idPostulant}', 'UserController@acceptSolicitude')
		->name('user.acceptSolicitude');
Route::delete('/cancel/{ride}', 'UserController@cancelSolicitude')
		->name('user.cancelSolicitude');
Route::post('/postulate/{ride}', 'UserController@postulate')
		->name('user.postulate');
Route::get('deletePassenger/{ride}/{idPassenger}', 'UserController@deletePassenger')
		->name('user.deletePassenger');


Route::post('qualificatePassenger/{ride}/{idPassenger}', 'UserController@qualificatePassenger')
    ->name('user.qualificatePassenger');
		
Route::resource('user', 'UserController');

Route::get('/califications', 'UserController@getCalifications');

Route::get('/editPass', 'UserController@editPassword');
Route::post('/newPass', 'UserController@updatePassword');




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

Route::get('/resetPassword', 'Auth\ForgotPasswordController@reset');



Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/new', 'Auth\ForgotPasswordController@sendResetLinkEmail');

Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::pattern('rides', '[0-9]+');
Route::get('/solicitudes/{solicitudes}', 'RideController@getSolicitudes')
		->name('ride.getSolicitudes');
Route::resource('ride', 'RideController');
Route::delete('delete/{id}', 'RideController@delete')
		->name('ride.delete');

Route::get('/result', 'RideController@getBy');

Route::post('/answer', 'CommentController@answer')
		->name('comment.answer');
Route::resource('comment', 'CommentController');

Route::get('myRides/{user}', 'RideController@myRides')->name('ride.myRides');
Route::get('payRide/{ride}', 'UserController@payRide')->name('user.payRide');
Route::post('pay/{ride}', 'UserController@pay')->name('user.pay');
Route::get('frequentQuestions', 'PagesController@getFrequentQuestions');
Route::get('termsAndConditions', 'PagesController@getTermsAndConditions');
