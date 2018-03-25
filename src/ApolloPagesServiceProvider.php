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
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'apollo-pages');

        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/apollo-pages'),
            ], 'apollo-pages-views');
        }
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->instance('apollopages', (new ApolloPages));

        $this->app->make(Http\Controllers\Admin\PageController::class);
        $this->app->make(Http\Controllers\Client\PageController::class);
    }
}
