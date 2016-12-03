<?php

namespace Weerd\ApolloPages\Http\Controllers;

use Illuminate\Http\Controller as BaseController;
use Weerd\ApolloPages\Models\ApolloPage;

class ApolloPageController extends BaseController implements ApolloPageConttract {
	/**
     * Display a list of pages.
     *
     * @return \Illuminate\Http\Response
     */
	public function index()
	{
		return 'displaying list of admin/client pages...';
	}

	/**
     * Display the specified page.
     *
     * @param  string $key
     * @return \Illuminate\Http\Response
     */
    public function show($key)
    {
    	// If $key is not numeric then find the page by its slug.
    	if (! is_numeric($key)) {
    		$page = ApolloPage::findBySlug($key);
    	}

    	// If $key is an integer, find page by the ID.
    	$page = ApolloPage::firstOrFail($key);

        // return view('pages.admin.show', ['page' => $page]);
        return 'showing admin/client page view...';
    }

    /**
     * Edit the specified page.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
     {
     	return 'editing the specified admin/client page';
     }

    /**
     * Create a new page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return 'creating a new admin/client page...';
    }

    /**
     * Delete the specified page.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
    	return 'deleting a specific admin/client page...';
    }
}
