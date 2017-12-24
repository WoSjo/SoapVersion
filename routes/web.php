<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Servers'], function () {

    Route::resource('servers', 'ServerController');

    Route::group(['prefix' => '{serverId}'], function () {
        Route::resource('endpoints', 'EndpointController');
    });
});
