<?php

function activeIfRouteIs($route)
{
    return request()->is($route) ? 'active' : '';
}

function getFileName($title, $ext)
{
    return str_slug($title) . '-' . time() . '.' . $ext;
}