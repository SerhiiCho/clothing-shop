<?php

use Gloudemans\Shoppingcart\Facades\Cart;

/**
 * These routes are loaded by the RouteServiceProvider within
 * a group which contains the "web" middleware group.
 */

// Resources
Auth::routes();
Route::resource('cards',  'CardController', ['except' => ['show']]);
Route::resource('slider', 'SliderController', ['except' => ['show']]);
Route::resource('contacts', 'ContactController', ['except' => ['show', 'index']]);

// Cart
<<<<<<< HEAD
Route::prefix('cart')->group(function () {
	Route::get('/','CartController@index');
	Route::post('/store','CartController@store');
	Route::delete('/{item}','CartController@destroy');
	Route::post('/addToFavorite/{id}','CartController@addToFavorite');
});

Route::prefix('checkout')->group(function () {
	Route::get('/','CheckoutController@index');
	Route::post('/','CheckoutController@store');
});

Route::prefix('favorite')->group(function () {
	Route::post('/addToCart/{id}','FavoriteItemController@addToCart');
	Route::delete('/{id}','FavoriteItemController@destroy');
=======
Route::get('/cart','CartController@index');
Route::post('/cart/store','CartController@store');
Route::delete('/cart/destroy','CartController@destroy');

Route::get('empty', function () {
	Cart::destroy();
>>>>>>> 6b9aa120b62b693410c5e895f35eb44f96cba4c1
});

// Items
Route::resource('items',  'ItemController', ['except' => ['show']]);
Route::get('item/{item}', 'ItemController@show');

// Page Controllers
Route::get('/', 'PageController@home');
Route::get('language/{lang}', 'PageController@lang');

// Search
Route::view('search', 'search');
Route::post('search', 'SearchController@handleTheRequest');

// User
Route::view('user/dashboard', 'user.dashboard')->middleware('auth');

// Artisan commands =======
Route::prefix('php/artisan')->group(function () {
	Route::get('cache/{url_key}',		  'ArtisanController@cache');
	Route::get('clear/{url_key}',		  'ArtisanController@clear');
	Route::get('storage/link/{url_key}',  'ArtisanController@link');
	Route::get('migrate/fresh/{url_key}', 'ArtisanController@migrate');
});