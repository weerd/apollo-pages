<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| The Admin and Client Page routes need be attempted last.
*/

// Successful package registration endpoint check
Route::get('apollo', function () {
    return ['status' => 'Apollo Pages routes are working!'];
});

// Admin Routes
Route::group(['namespace' => 'Weerd\ApolloPages\Http\Controllers\Admin', 'prefix' => 'admin'], function () {
    Route::resource('pages', 'PageController', ['as' => 'admin']);
});

// Client Routes (wildcard match requires these routes to be attempted last)
Route::group(['namespace' => 'Weerd\ApolloPages\Http\Controllers\Client'], function () {
    Route::get('{params?}', 'PageController@show')->where('params', '(.*)')->name('client.pages.show');
});
