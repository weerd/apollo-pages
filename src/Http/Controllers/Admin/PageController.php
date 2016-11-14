<?php

namespace Weerd\ApolloPages\Http\Controllers\Admin;

use Illuminate\Routing\Controller;

class PageController extends Controller
{
    // @TODO: would it be better to create BaseController with additional traits
    // like the laravel/laravel package does?

    public function __construct()
    {
        $this->middleware(['web', 'auth']);
    }

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
