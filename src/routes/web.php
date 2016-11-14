<?php

// Admin Routes
Route::group(['namespace' => 'Weerd\ApolloPages\Http\Controllers\Admin', 'prefix' => 'admin'], function() {
    Route::get('{page}', 'PageController@show');
});


// Client Routes
Route::group(['namespace' => 'Weerd\ApolloPages\Http\Controllers\Client'], function () {
    Route::get('{page}/{category}', 'PageController@show');
    Route::get('{page}', 'PageController@show');
});
