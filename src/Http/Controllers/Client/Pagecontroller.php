<?php

namespace Weerd\ApolloPages\Http\Controllers\Client;

use App\Http\Controllers\Controller as BaseController;
use Weerd\ApolloPages\Models\ApolloPage as Page;

class PageController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['web']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $path
     * @return \Illuminate\Http\Response
     */
    public function show($path)
    {
        $page = Page::where('path', '=', $path)->firstOrFail();

        return view('pages.client.show', ['page' => $page]);
    }
}
