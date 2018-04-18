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

Route::get('items/{category}', 'Api/ItemsController@index');
Route::get('item/{id}', 'Api/ItemsController@show');
Route::post('item', 'Api/ItemsController@store');
Route::put('item/{id}', 'Api/ItemsController@edit');
Route::delete('item/{id}', 'Api/ItemsController@destroy');
