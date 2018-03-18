<?php

namespace Weerd\ApolloPages\Tests\Feature;

use Illuminate\Foundation\Auth\User;
use Weerd\ApolloPages\Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Weerd\ApolloPages\Models\ApolloPage as Page;

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

    /** @test */
    public function authenticated_user_can_view_admin_page_listing()
    {
        $admin = new User;

        $response = $this->actingAs($admin)->get('admin/pages');

        $response->assertStatus(200);
        $response->assertSee('Page List');
    }

    /** @test */
    public function authenticated_user_can_view_admin_create_page_form()
    {
        $admin = new User;

        $response = $this->actingAs($admin)->get('admin/pages/create');

        $response->assertStatus(200);
        $response->assertSee('Create Page');
    }

    /** @test */
    public function authenticated_user_can_view_admin_edit_page_form()
    {
        $admin = new User;

        $pageTitle = 'Example Test Page';

        $page = factory(Page::class)->create([
            'title' => $pageTitle,
            'slug' => str_slug($pageTitle),
            'path' => str_slug($pageTitle),
        ]);

        $response = $this->actingAs($admin)->get('admin/pages/'.$page->id.'/edit');

        $response->assertStatus(200);
        $response->assertSee('Update Page');
    }

    /** @test */
    public function authenticated_user_viewing_admin_page_is_redirected_to_admin_edit_page_form()
    {
        $this->followingRedirects();

        $admin = new User;

        $pageTitle = 'Example Test Page';

        $page = factory(Page::class)->create([
            'title' => $pageTitle,
            'slug' => str_slug($pageTitle),
            'path' => str_slug($pageTitle),
        ]);

        $response = $this->actingAs($admin)->get('admin/pages/'.$page->id);

        $response->assertStatus(200);
        $response->assertSee('Update Page');
    }
}
