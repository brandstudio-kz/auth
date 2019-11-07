<?php

Route::group([
    'namespace' => 'BrandStudio\Auth\Http\Controllers',
    'prefix' => config('brandstudio.auth.route_prefix'),
    'middleware' => [],
], function() {
    Route::group([
        'middleware' => ['auth:api'],
    ], function() {
        Route::get('user', 'AuthController@getUser');
        Route::put('user', 'AuthController@updateLogin');
        Route::delete('user', 'AuthController@delete');
    });

    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');

    Route::post('password', 'AuthController@resetPassword');
    Route::put('password', 'AuthController@resetPassword')->middleware('auth:api');

    Route::get('verify', 'AuthController@verify')->name('verify');
    // TODO: refresh token
});
