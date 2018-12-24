<?php

/**
 * These routes are loaded by the RouteServiceProvider within
 * a group which contains the "web" middleware group.
 */
Route::get('logs',
    '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index'
)->middleware('admin');

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
Route::get('language/{lang}', 'PageController@lang');

// Search
Route::view('search', 'search');
Route::post('search', 'SearchController@handleTheRequest');

// Admin
Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::get('dashboard', 'DashboardController@index');
    Route::get('work', 'WorkController@index');
    Route::put('registration', 'OptionController@registration');
    Route::put('men-category', 'OptionController@menCategory');
    Route::put('women-category', 'OptionController@womenCategory');
    Route::put('cache-forget', 'OptionController@cacheForget');
    Route::resource('slider', 'SliderController', ['except' => ['show']]);
    Route::resource('cards', 'CardController', ['except' => ['show']]);
    Route::resource('contacts', 'ContactController', ['except' => ['show', 'index']]);
});

// Artisan commands =======
Route::prefix('php/artisan')->group(function () {
    Route::get('cache/{url_key}', 'ArtisanController@cache');
    Route::get('clear/{url_key}', 'ArtisanController@clear');
    Route::get('storage/link/{url_key}', 'ArtisanController@link');
    Route::get('migrate/fresh/{url_key}', 'ArtisanController@migrate');
});
