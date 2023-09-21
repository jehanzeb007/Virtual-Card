<?php

Route::get('card-login/{id}', 'AuthController@cardLogin')->name('cardLogin');
Route::post('card-register/{id}', 'AuthController@cardPostRegister')->name('card.register.post');
Route::post('card-login-post/{id}', 'AuthController@cardPostLogin')->name('card.login.post');

Route::get('login', 'AuthController@getLogin')->name('login');
Route::post('login', 'AuthController@postLogin')->name('login.post');

Route::get('login/{provider}', 'AuthController@redirectToProvider')->name('login.redirect');
Route::get('login/{provider}/callback', 'AuthController@handleProviderCallback')->name('login.callback');

Route::get('logout', 'AuthController@getLogout')->name('logout');

Route::get('register', 'AuthController@getRegister')->name('register');
Route::post('register', 'AuthController@postRegister')->name('register.post');

Route::get('password/reset', 'AuthController@getReset')->name('reset');
Route::post('password/reset', 'AuthController@postReset')->name('reset.post');
Route::get('password/reset/{email}/{code}', 'AuthController@getResetComplete')->name('reset.complete');
Route::post('password/reset/{email}/{code}', 'AuthController@postResetComplete')->name('reset.complete.post');
