<?php

use Illuminate\Support\Facades\Route;


Route::get('get-city', 'ApiLocationController@getCity');
Route::get('get-city-detail/{cityId}', 'ApiLocationController@getCityDetail');
Route::get('get-district-by-city/{cityId}', 'ApiLocationController@getDistrictByCity');
Route::get('get-district-detail/{districtId}', 'ApiLocationController@getDistrictDetail');
Route::get('get-ward-by-district/{districtId}', 'ApiLocationController@getWardByDistrict');
Route::get('get-ward-detail/{wardId}', 'ApiLocationController@getWardDetail');
