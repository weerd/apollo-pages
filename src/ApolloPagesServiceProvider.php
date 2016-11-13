<?php

namespace Weerd\ApolloPages;

use Illuminate\Support\ServiceProvider;

class ApolloPageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
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

    }
}
