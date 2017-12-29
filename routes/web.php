<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth'], 'namespace' => 'Servers'], function () {

    Route::resource('servers', 'ServerController');

    Route::group(['prefix' => '{server}', 'as' => 'servers.'], function () {
        Route::resource('endpoints', 'EndpointController');
    });
});
