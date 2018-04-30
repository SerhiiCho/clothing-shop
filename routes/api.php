<?php

use Illuminate\Http\Request;

/**
 * These routes are loaded by the RouteServiceProvider
 * within a group which is assigned the "api" middleware group
 */

Route::get('items/{sex?}', 'Api\ApiItemController@index');
Route::get('random', 'Api\ApiItemController@random');
Route::get('popular', 'Api\ApiItemController@popular');
Route::get('item/{item}', 'Api\ApiItemController@show');
Route::post('item', 'Api\ApiItemController@store');
Route::put('item/{id}', 'Api\ApiItemController@edit');
Route::delete('item/{id}', 'Api\ApiItemController@destroy');