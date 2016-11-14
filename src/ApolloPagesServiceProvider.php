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

        // $this->publishes([
        //     __DIR__.'/../config/package.php' => config_path('package.php')
        // ], 'config');

        // $this->publishes([
        //     __DIR__.'/../database/migrations/' => database_path('migrations')
        // ], 'migrations');

        $this->publishes([
            __DIR__.'/Http/Controllers/Admin/PageController.php' => app_path('Http/Controllers/Admin/PageController.php'),
            __DIR__.'/Http/Controllers/Client/PageController.php' => app_path('Http/Controllers/Test/PageController.php')
        ], 'controllers');
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
