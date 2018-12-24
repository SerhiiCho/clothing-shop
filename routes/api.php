<?php

/**
 * These routes are loaded by the RouteServiceProvider
 * within a group which is assigned the "api" middleware group
 */

Route::namespace ('Api')->group(function () {

    // Item
    Route::prefix('item')->group(function () {
        Route::post('/', 'ApiItemController@store');
        Route::get('random/{category}', 'ApiItemController@random');
        Route::put('{id}', 'ApiItemController@edit');
        Route::get('popular', 'ApiItemController@popular');
        Route::get('{item}', 'ApiItemController@show');
        Route::delete('{id}', 'ApiItemController@destroy');
    });

    // Items
    Route::prefix('items')->group(function () {
        Route::get('{category?}/{type?}', 'ApiItemController@index');
    });

    // Messages clients orders
    Route::prefix('clients_orders')->group(function () {
        Route::get('index', 'ApiMessageController@index');
        Route::post('store', 'ApiMessageController@store');
        Route::delete('destroy/{id}', 'ApiMessageController@destroy');
    });

    // Slider
    Route::get('slider/main', 'ApiSliderController@main');
    Route::get('slider/cards', 'ApiSliderController@cards');
});
