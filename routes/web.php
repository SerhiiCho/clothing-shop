<?php

/**
 * These routes are loaded by the RouteServiceProvider within
 * a group which contains the "web" middleware group.
 */

Auth::routes();

// Items
Route::resource('items', 'ItemController', ['except' => ['show']]);
Route::get('item/{item}', 'ItemController@show');

// Page Controllers
Route::get('/', 'PageController@home');
Route::get('language/{lang}', 'PageController@lang');

// Cards
Route::resource('cards', 'CardController', ['except' => ['show']]);

// User
Route::view('user/dashboard', 'user.dashboard')->middleware('auth');

// Artisan commands =======
Route::prefix('php/artisan')->group(function () {
	Route::get('cache/{url_key}', 'ArtisanController@cache');
	Route::get('clear/{url_key}', 'ArtisanController@clear');
	Route::get('storage/link/{url_key}', 'ArtisanController@link');
	Route::get('migrate/fresh/{url_key}', 'ArtisanController@migrate');
});