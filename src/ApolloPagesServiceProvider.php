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
        if ($this->app->runningInConsole()) {
            $this->commands([
                Weerd\ApolloPages\Console\MakePagesCommand::class,
            ]);
        }

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // if (! $this->app->routesAreCached()) {
        //     require __DIR__.'/routes/web.php';
        // }

        // $this->publishes([
        //     __DIR__.'/../config/package.php' => config_path('package.php')
        // ], 'config');

        // $this->publishes([
        //     __DIR__.'/../database/migrations/' => database_path('migrations')
        // ], 'migrations');

        // Copy controller classes to project and create directories if they do not exist.
        $this->publishes([
            __DIR__.'/Http/Controllers/Admin/PageController.php' => app_path('Http/Controllers/Admin/PageController.php'),
            __DIR__.'/Http/Controllers/Client/PageController.php' => app_path('Http/Controllers/Client/PageController.php')
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
