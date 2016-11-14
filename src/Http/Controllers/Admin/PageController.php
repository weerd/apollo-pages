<?php

namespace Weerd\ApolloPages\Http\Controllers\Client;

use Illuminate\Routing\Controller;

class PageController extends Controller
{
    // @TODO: would it be better to create BaseController with additional traits
    // like the laravel/laravel package does?

    /**
     * Display the specified admin page.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // $slug
        // $page = Page::findBySlug($slug);

        // return view('pages.admin.show', ['page' => $page]);

        return 'showing admin view...';
    }
}
