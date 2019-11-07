<?php

Route::group([
    'namespace' => 'BrandStudio\Auth\Http\Controllers',
    'prefix' => config('brandstudio.auth.route_prefix'),
    'middleware' => [],
], function() {
    Route::get('user', 'AuthController@getUser')->middleware('auth:api');

    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');

    Route::prefix('password', function() {
        Route::post('update', 'AuthController@resetPassword')->middleware('auth:api');
        Route::post('reset', 'AuthController@resetPassword');
    });

    Route::put('update', 'AuthController@updateLogin')->middleware('auth:api');
    Route::get('verify', 'AuthController@verify')->name('verify');
    // TODO: refresh token
});
