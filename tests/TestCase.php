<?php

namespace Weerd\ApolloPages\Tests;

use Orchestra\Testbench\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Weerd\ApolloPages\ApolloPagesServiceProvider;

abstract class TestCase extends BaseTestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate', ['--database' => 'testing']);

        $this->withFactories(__DIR__.'/../database/factories');
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [ApolloPagesServiceProvider::class];
    }

    /**
     * Disable Laravel's exception handling when needed.
     *
     * @return StdClass
     */
    protected function disableExceptionHandling()
    {
        $this->app->instance(ExceptionHandler::class, new class extends Handler {
            public function __construct()
            {
            }

            public function report(\Exception $exception)
            {
                // no-op
            }

            public function render($request, \Exception $exception)
            {
                throw $exception;
            }
        });
    }
}
