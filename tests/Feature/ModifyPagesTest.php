<?php

namespace Weerd\ApolloPages\Tests\Feature;

use Illuminate\Foundation\Auth\User;
use Weerd\ApolloPages\Tests\TestCase;
use Weerd\ApolloPages\Models\ApolloPage as Page;

class ModifyPagesTest extends TestCase
{
    /** @test */
    public function authenticated_user_can_create_a_new_page()
    {
        $admin = new User;

        $pageTitle = 'Example Test Page';

        $response = $this->actingAs($admin)->json('POST', '/admin/pages', [
            'slug' => str_slug($pageTitle),
            'path' => str_slug($pageTitle),
            'title' => $pageTitle,
        ]);

        $response->assertRedirect();

        $page = Page::find(1);

        $this->assertNotNull($page);
        $this->assertEquals($pageTitle, $page->title);
    }

    /** @test */
    public function authenticated_user_can_update_an_existing_page()
    {
        $admin = new User;

        $pageTitle = 'Example Test Page';

        $page = factory(Page::class)->create([
            'title' => $pageTitle,
            'slug' => str_slug($pageTitle),
            'path' => str_slug($pageTitle),
        ]);

        $response = $this->actingAs($admin)->json('PATCH', '/admin/pages/'.$page->id, [
            'title' => 'New Page Title',
        ]);

        $response->assertRedirect();

        $page = Page::find($page->id);

        $this->assertEquals('New Page Title', $page->title);
    }

    /** @test */
    public function authenticated_user_can_delete_an_existing_page()
    {
        $admin = new User;

        $pageTitle = 'Example Test Page';

        $page = factory(Page::class)->create([
            'title' => $pageTitle,
            'slug' => str_slug($pageTitle),
            'path' => str_slug($pageTitle),
        ]);

        $response = $this->actingAs($admin)->json('DELETE', '/admin/pages/'.$page->id);

        $response->assertRedirect();

        $page = Page::find($page->id);

        $this->assertNull($page);
    }
}
