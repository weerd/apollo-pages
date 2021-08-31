<?php

namespace Weerd\ApolloPages;

use Illuminate\Support\ServiceProvider;
use Weerd\ApolloPages\Models\ApolloPage;

class ApolloPagesServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make(Http\Controllers\Admin\PageController::class);
        $this->app->make(Http\Controllers\Client\PageController::class);
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'apollo-pages');

        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/apollo-pages'),
            ], 'apollo-pages-views');
        }

        view()->composer([
            'apollo-pages::pages.admin.create',
            'apollo-pages::pages.admin.edit',
        ], function ($view) {
            $view->with('pageList', ApolloPage::all());
        });
    }
}
