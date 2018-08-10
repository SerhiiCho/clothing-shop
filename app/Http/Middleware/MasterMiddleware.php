<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MasterMiddleware
{
    // Handle an incoming request.
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check() && Auth::user()->isMaster()) {
            return $next($request);
        }

        return redirect('/')->withError(trans('messages.have_no_rights'));
    }
}
