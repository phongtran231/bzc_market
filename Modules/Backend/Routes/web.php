<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::group([
    'prefix' => 'bzc-admin-manager',
], function() {
    Route::group([
        'prefix' => 'login',
    ], function () {
        Route::match([Request::METHOD_GET, Request::METHOD_POST], '/', 'LoginController@login')->name('backend.login');
    });

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/', 'BackendController@index');
    });
});
