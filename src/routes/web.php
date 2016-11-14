<?php

// Admin Routes
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function() {
    Route::get('{page}', 'PageController@show');
});


// Client Routes
Route::group(['namespace' => 'Client'], function () {
    Route::get('{page}/{category}', 'PageController@show');
    Route::get('{page}', 'PageController@show');
});
