<?php

// Helper for giving an active button class "avtive"
function activeIfRouteIs($route, $request = null, $get = null) {
	if ($request) {
		return request($request) == $get ? 'active' : '';
	}
	return request()->is($route) ? 'active' : '';
}

/**
 * This function is needed for getting name
 * for images than I'm saving in storage
 */
function getFileName($title, $ext) {
    return str_slug($title) . '-' . str_random(20) . '.' . $ext;
}

/**
 * After editing stylesheets this function will update
 * timestamp on its file, it prevents browser caching
 */
function styleTimestamp($path) {
	try {
		$timestamp = '?v=' . File::lastModified(public_path() . $path);
	} catch (Exception $e) {
		$timestamp = '';
	}
	return '<link rel="stylesheet" href="' . $path . $timestamp . '">';
}

/**
 * This helper helps clean Item controller by separeting
 * this logic to helper
 */
function whatIsCurrent($param) {
	if (str_contains(request()->fullUrl(), 'women')) {
		if ($param === 'category') {
			return 'women';
		} elseif ($param === 'title') {
			return trans('items.women_items');
		}
	} elseif (str_contains(request()->fullUrl(), 'men')) {
		if ($param === 'category') {
			return 'men';
		} elseif ($param === 'title') {
			return trans('items.men_items');
		}
	} else {
		if ($param === 'category') {
			return '';
		} elseif ($param === 'title') {
			return trans('items.all_items');
		}
	}
}

