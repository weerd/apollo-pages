<?php

namespace Weerd\ApolloPages\Tests;

use Illuminate\Foundation\Console\RouteListCommand;
use Illuminate\Support\Facades\Artisan;
use Weerd\ApolloPages\Models\ApolloPage as Page;

class ViewPagesTest extends TestCase
{
    /** @test */
    public function page_routes_successfully_registered()
    {
        $response = $this->get('apollo');

        $response->assertStatus(200);
        $response->assertSee('Apollo Pages');
    }

    /** @test */
    public function user_can_view_a_page()
    {
        // dump($this->app->config->get('app.providers'));

        $page = Page::create([
            'title' => 'Example Test Page',
            'slug' => 'example-test-page',
            'path' => 'example-test-page',
            'tier' => 1,
        ]);

        // dump(Page::first()->toArray());

        $response = $this->get('example-test-page');

        $response->assertStatus(200);
    }
}
