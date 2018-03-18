<?php

namespace Weerd\ApolloPages\Tests;

use Illuminate\Support\Facades\Artisan;
use Weerd\ApolloPages\Models\ApolloPage as Page;
use Illuminate\Foundation\Console\RouteListCommand;

class ViewPagesTest extends TestCase
{
    /** @test */
    public function page_routes_successfully_registered()
    {
        $response = $this->get('status/apollo');

        $response->assertStatus(200);
        $response->assertSee('Apollo Pages');
    }

    /** @test */
    public function user_can_view_a_page()
    {
        $pageTitle = 'Example Test Page';

        $page = factory(Page::class)->create([
            'title' => $pageTitle,
            'slug' => str_slug($pageTitle),
            'path' => str_slug($pageTitle),
        ]);

        $response = $this->get($page->path);

        $response->assertStatus(200);
        $response->assertSee('Example Test Page');
    }

    /** @test */
    public function unauthenticated_user_cannot_view_admin_page_listing()
    {
        $response = $this->get('admin/pages');

        // @TODO: Not an ideal test.
        // Redirects to /login if not authenticated, but page does not
        // exist in test environment.
        $response->assertStatus(500);
    }

    /** @test */
    public function unauthenticated_user_cannot_view_admin_create_page_form()
    {
        $response = $this->get('admin/pages/create');

        // @TODO: Not an ideal test.
        // Redirects to /login if not authenticated, but page does not
        // exist in test environment.
        $response->assertStatus(500);
    }
}
