<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix' => 'bzc-admin-manager',
    'namespace' => 'Api'
], function () {
    Route::post('login', 'Admin\AuthController@login')->name('admin.login');
    Route::post('reset-password', 'Admin\AuthController@forgetPassword')->name('admin.reset-password');

    /**
     * Auth router
     */

    Route::get('get-user-profile', 'Admin\AuthController@getUserProfile')->name('admin.get-user-profile');

    Route::group([
        'prefix' => 'core-config',
    ], function () {
        Route::get('/', 'CoreConfigController@index')->name('admin.core-config.index');
        Route::get('paginate', 'CoreConfigController@getCoreConfigPaginate')->name('admin.core-config.paginate');
        Route::get('{id}', 'CoreConfigController@show');
    });
    /**
     * End auth router
     */
});
