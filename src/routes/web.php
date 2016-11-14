<?php

// Admin Routes
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function() {
    Route::get('{page}', 'Weerd\ApolloPages\Http\Controllers\Admin\PageController@show');
});


// Client Routes
Route::group(['namespace' => 'Client'], function () {
    Route::get('{page}/{category}', 'Weerd\ApolloPages\Http\Controllers\Client\PageController@show');
    Route::get('{page}', 'Weerd\ApolloPages\Http\Controllers\Client\PageController@show');
});
