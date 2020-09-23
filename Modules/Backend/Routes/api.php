<?php

use Illuminate\Support\Facades\Route;

$defaultExcept = ['create', 'edit'];

Route::group([
    'prefix' => 'bzc-admin-manager',
    'namespace' => 'Api'
], function () use ($defaultExcept) {
    Route::post('login', 'Admin\AuthController@login')->name('admin.login');
    Route::post('forget-password', 'Admin\AuthController@forgetPassword')->name('admin.forget-password');

    /**
     * Auth router
     */

    Route::group([
        'middleware' => ['auth:admin']
    ], function () use ($defaultExcept) {

        Route::get('get-user-profile', 'Admin\AuthController@getUserProfile')->name('admin.get-user-profile');
        /** Core config */
        Route::resource('core-config', 'CoreConfigController')->names('admin.core-config')->except($defaultExcept);

        /** ACL */
        Route::group([
            'prefix' => 'permission-role',
            'namespace' => 'Admin'
        ], function () {
            Route::post('create-role', 'ACLController@createRole')->name('admin.acl.create-role')->middleware(['role:super_admin']);
            Route::post('create-permission', 'ACLController@createPermission')->name('admin.acl.create-permission')->middleware('role:super_admin');
            Route::post('set-role-for-admin', 'ACLController@setRoleForAdmin')->name('admin.acl.set-role-for-admin')->middleware('role:super_admin');
        });

        /** Shop Owner */
        Route::resource('shop-owner', 'ShopOwnerController')->names('admin.shop-owner')->except($defaultExcept);
//        Route::post('shop-owner/{token}/reset-password', 'ShopOwnerController@resetPassword');
        // TODO: đem route đổi mật khẩu shop owner qua module ShopOwner
    });

    /**
     * End auth router
     */
});
