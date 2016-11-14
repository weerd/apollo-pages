<?php

namespace Weerd\ApolloPages;

use Illuminate\Support\ServiceProvider;

class ApolloPagesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if (! $this->app->routesAreCached()) {
            require __DIR__.'/routes/web.php';
        }
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
