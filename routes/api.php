<?php

use Illuminate\Http\Request;

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

Route::get('items/{sex?}/{category?}', 'Api\ApiItemController@index');
Route::get('item/{id}', 'Api\ApiItemController@show');
Route::post('item', 'Api\ApiItemController@store');
Route::put('item/{id}', 'Api\ApiItemController@edit');
Route::delete('item/{id}', 'Api\ApiItemController@destroy');
