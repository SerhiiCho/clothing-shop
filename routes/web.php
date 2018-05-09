<?php

/**
 * These routes are loaded by the RouteServiceProvider within
 * a group which contains the "web" middleware group.
 */

// Resources
Auth::routes();
Route::resource('items',  'ItemController', 	['except' => ['show']]);
Route::resource('cards',  'CardController', 	['except' => ['show']]);
Route::resource('slider', 'SliderController', 	['except' => ['show']]);

// Items
Route::get('item/{item}', 'ItemController@show');

// Page Controllers
Route::get('/', 'PageController@home');
Route::get('language/{lang}', 'PageController@lang');

Route::get('search', 'SearchController@index');
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