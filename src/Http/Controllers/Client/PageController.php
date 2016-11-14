<?php

namespace Weerd\ApolloPages\Http\Controllers\Client;

use Illuminate\Routing\Controller;

class PageController extends Controller
{
    // @TODO: would it be better to create BaseController with additional traits
    // like the laravel/laravel package does?

    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Display the specified client page.
     *
     * @param  string  $page
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // $page, $category = null
        // $page = Page::findBySlug($page);

        // return view('pages.client.show', ['page' => $page]);

        return 'showing client view...';
    }
}
