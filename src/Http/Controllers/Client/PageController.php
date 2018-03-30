<?php

namespace Weerd\ApolloPages\Http\Controllers\Client;

use Weerd\ApolloPages\Models\ApolloPage as Page;
use Weerd\ApolloPages\Http\Controllers\Controller as BaseController;

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

        $parent_id = $page->parent_id ?: $page->id;

        $parentPage = null;

        if ($parent_id !== $page->id) {
            $parentPage = Page::find($parent_id);
        }

        return view('apollo-pages::pages.client.show', [
            'page' => $page,
            'subpages' => Page::childrenOf($parent_id)->get(),
            'parentPage' => $parentPage,
        ]);
    }
}
