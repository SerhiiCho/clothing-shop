<?php

use App\Models\Visitor;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

/**
 * Alias for auth() helper
 *
 * @codeCoverageIgnore
 */
function user()
{
    return auth()->user();
}

/**
 * Helper for giving an active button class "active"
 *
 * @param $route
 * @param null $request
 * @param null $get
 * @return string
 */
function active_if_route_is($route, $request = null, $get = null)
{
    if ($request) {
        return request($request) == $get ? 'active' : '';
    }
    return request()->is($route) ? 'active' : '';
}

/**
 * This function is needed for getting name
 * for images then they will be saved in storage
 *
 * @codeCoverageIgnore
 * @param string $title
 * @param string $ext - extension
 * @return string
 */
function get_file_name(string $title, string $ext): string
{
    return str_slug($title) . '-' . string_random(7) . '.' . $ext;
}

function string_random(int $length): string
{
    return Str::random($length);
}

/**
 * This helper helps clean Item controller by separating
 * this logic to helper
 *
 * @param string $param
 * @return string
 */
function what_is_current(string $param): ?string
{
    if ($param === 'category') {
        if (Str::contains(request()->fullUrl(), 'women')) {
            return 'women';
        }
        if (Str::contains(request()->fullUrl(), 'men')) {
            return 'men';
        }
        return '';
    }

    if ($param === 'title') {
        if (Str::contains(request()->fullUrl(), 'women')) {
            return trans('items.women_items');
        }
        if (Str::contains(request()->fullUrl(), 'men')) {
            return trans('items.men_items');
        }
        return trans('items.all_items');
    }

    return null;
}

function no_connection_error(Exception $exception, string $file): void
{
    logger()->error("{$exception->getMessage()} in file $file.php");
    session()->flash('error', trans('messages.query_error'));
}

// It returns visitor_id even if cookie is not set
function visitor_id()
{
    if (request()->cookie('cs_rotsiv')) {
        return request()->cookie('cs_rotsiv');
    }
    $visitor_id = Visitor::whereIp(request()->ip())->value('id');
    Cookie::queue('cs_rotsiv', $visitor_id, 218400);

    return $visitor_id;
}

/**
 * Removes all cache
 *
 * @return void
 */
function forget_all_cache(): void
{
    array_map(function ($name) {
        cache()->forget($name);
    }, config('cache.cache_names'));
}
