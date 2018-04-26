<?php

function activeIfRouteIs($route)
{
    return request()->is($route) ? 'active' : '';
}