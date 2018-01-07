<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SoapVersion\Mail\EndpointDifferenceFound;
use SoapVersion\Models\Version\Version;

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

Route::group(['prefix' => '{endpoint}', 'as' => 'endpoints.'], function () {
    Route::resource('versions', 'VersionController');
    Route::get('versions/{version}/mail', function ($endpoint, $version) {
        $endpoint = \SoapVersion\Models\Server\Endpoint::find($endpoint);
        $version = Version::find($version);
        return new EndpointDifferenceFound($endpoint, $version);
    })->name('versions.mail');
});
