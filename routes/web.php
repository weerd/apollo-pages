<?php

use Illuminate\Support\Facades\Route;

Route::get('apollo', function() {
    return 'Apollo Pages routes are working.';
});

/*
| The following Page routes need be attempted last.
*/

// Admin Routes
Route::group(['namespace' => 'Weerd\ApolloPages\Http\Controllers\Admin', 'prefix' => 'admin'], function() {
    Route::resource('pages', 'PageController', ['as' => 'admin']);
});

// Client Routes
Route::group(['namespace' => 'Weerd\ApolloPages\Http\Controllers\Client'], function () {
    Route::get('{params?}', 'PageController@show')->where('params', '(.*)')->name('client.pages.show');
});
