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
    'namespace' => 'Api\Admin'
], function () {
    Route::post('login', 'AuthController@login')->name('admin.login');
    Route::post('reset-password', 'AuthController@forgetPassword')->name('admin.reset-password');

    /**
     * Auth router
     */

    Route::get('get-user-profile', 'AuthController@getUserProfile')->name('admin.get-user-profile');

    /**
     * End auth router
     */
});
