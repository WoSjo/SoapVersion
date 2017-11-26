<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['namespace' => 'Dashboard', 'middleware' => 'auth'], function () {
    Route::resource('soap_servers', 'SoapServersController');
});
