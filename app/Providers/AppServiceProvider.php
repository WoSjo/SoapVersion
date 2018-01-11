<?php

namespace SoapVersion\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use SoapVersion\Parsers\Parser;
use SoapVersion\Parsers\ParserInterface;
use Sven\ArtisanView\ServiceProvider as ArtisanViewServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
        
        if ($this->app->environment() !== 'production') {
            $this->app->register(ArtisanViewServiceProvider::class);
        }

        $this->app->bind(ParserInterface::class, Parser::class);
    }
}
