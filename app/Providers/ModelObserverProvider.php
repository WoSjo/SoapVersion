<?php

namespace SoapVersion\Providers;

use Illuminate\Support\ServiceProvider;
use SoapVersion\Models\Dashboard\Soap\Server;
use SoapVersion\Observers\Soap\ServerObserver;

class ModelObserverProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Server::observe(ServerObserver::class);
    }
}
