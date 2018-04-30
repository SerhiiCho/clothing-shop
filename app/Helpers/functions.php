<?php

function activeIfRouteIs($route, $get = null)
{
	if (request('category')) {
		return request('category') == $get ? 'active' : '';
	}
	return request()->is($route) ? 'active' : '';
}

function getFileName($title, $ext)
{
    return str_slug($title) . '-' . time() . '.' . $ext;
}