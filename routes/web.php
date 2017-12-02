<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Dashboard', 'prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::group(['prefix' => 'soap', 'as' => 'soap.'], function () {
        Route::resource('servers', 'SoapServersController');
    });
});
