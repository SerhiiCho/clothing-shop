<?php

/**
 * These routes are loaded by the RouteServiceProvider
 * within a group which is assigned the "api" middleware group
 */

Route::namespace ('Api')->group(function () {
    Route::prefix('item')->group(function () {
        Route::post('/', 'ApiItemController@store');
        Route::get('random/{visitor_id}/{category?}', 'ApiItemController@random');
        Route::put('{id}', 'ApiItemController@edit');
        Route::get('popular', 'ApiItemController@popular');
        Route::get('{item}', 'ApiItemController@show');
        Route::delete('{id}', 'ApiItemController@destroy');
    });

    Route::prefix('orders')->group(function () {
        Route::post('open', 'ApiOrderController@open');
        Route::post('taken', 'ApiOrderController@taken');
        Route::post('closed', 'ApiOrderController@closed');
    });

    Route::get('items/{category?}/{type?}', 'ApiItemController@index');
    Route::get('slider/main', 'ApiSliderController@main');
    Route::get('slider/cards', 'ApiSliderController@cards');
});
