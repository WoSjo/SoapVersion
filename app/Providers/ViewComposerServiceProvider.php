<?php

namespace SoapVersion\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use SoapVersion\Http\ViewComposers\ServerFormComposer;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('servers.partials.form', ServerFormComposer::class);
    }
}
