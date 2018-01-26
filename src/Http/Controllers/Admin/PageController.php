<?php

namespace Weerd\ApolloPages\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Weerd\ApolloPages\Models\ApolloPage as Page;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        $this->middleware(['web', 'auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('apollo-pages::pages.admin.index', ['pages' => Page::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('apollo-pages::pages.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request = Page::assignProcessedAttributes($request);

        $this->validate($request, [
            'slug' => 'required',
            'path' => 'required|unique:pages',
            'parent_id' => 'nullable|numeric',
            'tier' => 'required|digits:1',
            'title' => 'required',
        ]);

        $page = Page::create([
            'slug' => $request->input('slug'),
            'path' => $request->input('path'),
            'parent_id' => $request->input('parent_id'),
            'tier' => $request->input('tier'),
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);

        return redirect()->route('admin.pages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // @TODO: maybe use this route to show a preview of a page?

        $page = Page::findOrFail($id);

        return redirect()->route('admin.pages.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('apollo-pages::pages.admin.edit', ['page' => Page::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $page = Page::find($id);

        $page->fill($request->all())->save();

        return redirect()->route('admin.pages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::findOrFail($id);

        $deletion = $page->destroy($id);

        if (! $deletion) {
            throw new ModelNotFoundException;
        }

        return redirect()->route('admin.pages.index');
    }
}
