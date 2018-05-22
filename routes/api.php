<?php

use Illuminate\Http\Request;

/**
 * These routes are loaded by the RouteServiceProvider
 * within a group which is assigned the "api" middleware group
 */

Route::namespace('Api')->group(function () {

	// Item
	Route::prefix('item')->group(function () {
		Route::post('/', 'ApiItemController@store');
		Route::get('random', 'ApiItemController@random');
		Route::put('{id}', 'ApiItemController@edit');
		Route::get('popular', 'ApiItemController@popular');
		Route::get('{item}', 'ApiItemController@show');
		Route::delete('{id}', 'ApiItemController@destroy');
	});

	// Items
	Route::prefix('items')->group(function () {
		Route::get('{category?}/{type?}', 'ApiItemController@index');
		// Route::get('type/{id}', 'ApiItemController@type');
	});

	// Messages clients orders
	Route::prefix('clients_orders')->group(function () {
		Route::get('index', 'ApiMessageController@index');
		Route::post('store', 'ApiMessageController@store');
		Route::delete('destroy/{id}', 'ApiMessageController@destroy');
	});

	// Other
	Route::get('other/slider', 'ApiOtherController@slider');
});
