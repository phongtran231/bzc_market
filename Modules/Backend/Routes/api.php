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
        Route::group([
            'prefix' => 'core-config',
        ], function () {
            Route::get('/', 'CoreConfigController@index')->name('admin.core-config.index')->middleware('role_or_permission:super-admin|admin-core-config.index');
            Route::post('/', 'CoreConfigController@store')->name('admin.core-config.store')->middleware('role_or_permission:super-admin|admin-core-config.index');
            Route::put('{core_config}', 'CoreConfigController@update')->name('admin.core-config.update')->middleware('role_or_permission:super-admin|admin-core-config.update');
            Route::delete('{core_config}', 'CoreConfigController@destroy')->name('admin.core-config.destroy')->middleware('role_or_permission:super-admin|admin-core-config.destroy');
        });

        /** ACL */
        Route::group([
            'prefix' => 'permission-role',
            'namespace' => 'Admin',
            'middleware' => 'role:super-admin'
        ], function () {
            Route::post('create-role', 'ACLController@createRole')->name('admin.acl.create-role');
            Route::post('create-permission', 'ACLController@createPermission')->name('admin.acl.create-permission');
            Route::post('set-role-for-admin', 'ACLController@setRoleForAdmin')->name('admin.acl.set-role-for-admin');
        });

        /** Product Category */
        Route::group([
            'prefix' => 'product-category',
        ], function () {
            Route::get('/', 'ProductCategoryController@index')->name('admin.product-category.index')->middleware('role_or_permission:super-admin|admin-product-category.index');
        });
        Route::resource('product-category', 'ProductCategoryController')->names('admin.product-category')
            ->except($defaultExcept)->middleware('role_or_permission:super-admin|product-category.*');

        /** Product */
        Route::resource('product', 'ProductController')->names('admin.product')->except($defaultExcept)->middleware('role_or_permission:super-admin|product.*');

        /** Shop Owner */
        Route::resource('shop-owner', 'ShopOwnerController')->names('admin.shop-owner')->except($defaultExcept)->middleware('role:super-admin');

        /** Product Attribute Group */
        Route::resource('product-attribute-group', 'ProductAttributeGroupController')->names('admin.product-attribute-group')
            ->except($defaultExcept)->middleware('role:super-admin');

        /** Product Attribute */
        Route::group([
            'prefix' => 'product-attribute',
            'middleware' => 'role_or_permission:super-admin|product-attribute.*'
        ], function () use ($defaultExcept) {
            Route::resource('', 'ProductAttributeController')->names('admin.product-attribute')
                ->except($defaultExcept);
            Route::post('set-group/{product_attribute}', 'ProductAttributeController@setGroup')->name('admin.product-attribute.set-group');
        });

//        Route::post('shop-owner/{token}/reset-password', 'ShopOwnerController@resetPassword');
        // TODO: đem route đổi mật khẩu shop owner qua module ShopOwner
    });

    /**
     * End auth router
     */
});
