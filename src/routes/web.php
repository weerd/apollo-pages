<?php

// Admin Routes
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function() {
    Route::get('{page}', 'PagesController@show');
});


// Client Routes
Route::group(['namespace' => 'Client'], function () {
    Route::get('{page}/{category}', 'PagesController@show');
    Route::get('{page}', 'PagesController@show');
});
