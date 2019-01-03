<?php

/**
 * These routes are loaded by the RouteServiceProvider within
 * a group which contains the "web" middleware group.
 */
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')
    ->middleware('admin');

Route::prefix(config('custom.enter_slug'))->group(function () {
    Auth::routes();
});

// Cart
Route::prefix('cart')->group(function () {
    Route::get('/', 'CartController@index');
    Route::post('/store', 'CartController@store');
    Route::delete('/{item}', 'CartController@destroy');
    Route::post('/add-to-favorite/{item}', 'CartController@addToFavorite');
});

Route::prefix('favorite')->group(function () {
    Route::post('/switch-to-cart/{item}', 'FavoriteItemController@switchToCart');
    Route::delete('/{item}', 'FavoriteItemController@destroy');
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
    Route::get('work/{tab?}', 'WorkController@index');
    Route::put('orders/{order}', 'OrderController@softDelete');
    Route::delete('orders/{order}', 'OrderController@destroy');
    Route::put('registration', 'OptionController@registration');
    Route::put('men-category', 'OptionController@menCategory');
    Route::put('women-category', 'OptionController@womenCategory');
    Route::put('cache-forget', 'OptionController@cacheForget');
    Route::resource('slider', 'SliderController', ['except' => ['show']]);
    Route::resource('cards', 'CardController', ['except' => ['show']]);
    Route::resource('users', 'UserController', ['only' => ['index', 'destroy', 'update']]);
    Route::resource('contacts', 'ContactController', ['except' => ['show', 'index']]);
    Route::put('sections/{section}', 'SectionController@update');
});
