<?php

/**
 * These routes are loaded by the RouteServiceProvider within
 * a group which contains the "web" middleware group.
 */
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')
    ->middleware('admin');

Auth::routes();

// Cart
Route::prefix('cart')->group(function () {
    Route::get('/', 'CartController@index');
    Route::post('/store', 'CartController@store');
    Route::delete('/{item}', 'CartController@destroy');
});

Route::prefix('checkout')->group(function () {
    Route::get('/', 'CheckoutController@index');
    Route::post('/', 'CheckoutController@store');
});

// Items
Route::resource('items', 'ItemController', ['except' => ['show']]);
Route::get('item/{category}/{item}', 'ItemController@show');

// Page Controllers
Route::get('/', 'PageController@home');
Route::post('search', 'PageController@search');
Route::view('search', 'pages.search');

// Admin
Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::get('dashboard', 'DashboardController@index');
    Route::get('orders', 'OrderController@index');
    Route::put('orders/{order}', 'OrderController@softDelete');
    Route::post('orders/{order}', 'OrderController@store');
    Route::delete('orders/{order}', 'OrderController@destroy');
    Route::put('registration', 'OptionController@registration');
    Route::put('men-category', 'OptionController@menCategory');
    Route::put('women-category', 'OptionController@womenCategory');
    Route::put('category-title', 'OptionController@categoryTitle');
    Route::put('cache-forget', 'OptionController@cacheForget');
    Route::resource('slider', 'SliderController', ['except' => ['show']]);
    Route::resource('cards', 'CardController', ['except' => ['show']]);
    Route::resource('contacts', 'ContactController', ['except' => ['show']]);
    Route::put('sections/{section}', 'SectionController@update');
    Route::get('table', 'TableController@index');
});

Route::prefix('master')->namespace('Master')->group(function () {
    Route::resource('users', 'UserController', ['only' => ['index', 'destroy', 'update']]);
});
