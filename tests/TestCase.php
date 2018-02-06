<?php

namespace Weerd\ApolloPages\Tests;

// use Illuminate\Database\Capsule\Manager as DB;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Weerd\ApolloPages\ApolloPagesServiceProvider;

abstract class TestCase extends BaseTestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();

        $this->artisan('migrate', ['--database' => 'testing']);
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
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        $app['router']->get('example-test-page', function () {
            return ['status' => 'poop'];
        });
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
}
