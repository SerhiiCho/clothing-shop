<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function registration(Request $request): RedirectResponse
    {
        if ($request->has('option') && $request->option === 'on') {
            Option::set('registration', 1);

            return redirect('/admin/dashboard')
                ->withSuccess(trans('options.registration_enabled'));
        }

        Option::set('registration', 0);

        return redirect('/admin/dashboard')
            ->withSuccess(trans('options.registration_disabled'));
    }

    public function firstCategory(Request $request): RedirectResponse
    {
        if ($request->has('option') && $request->option === 'on') {
            Option::set('category1', 1);

            return redirect('/admin/dashboard')
                ->withSuccess(trans('options.category1_enabled'));
        }

        Option::set('category1', 0);

        return redirect('/admin/dashboard')
            ->withSuccess(trans('options.category1_disabled'));
    }

    public function secondCategory(Request $request): RedirectResponse
    {
        if ($request->has('option') && $request->option === 'on') {
            Option::set('category2', 1);

            return redirect('/admin/dashboard')
                ->withSuccess(trans('options.category2_enabled'));
        }

        Option::set('category2', 0);

        return redirect('/admin/dashboard')
            ->withSuccess(trans('options.category2_disabled'));
    }

    public function categoryTitle(Request $request): RedirectResponse
    {
        Option::set('category1_title', $request->first);
        Option::set('category2_title', $request->second);

        return redirect('/admin/dashboard')
            ->withSuccess(trans('options.category1_title_changed'));
    }

    public function cacheForget(): RedirectResponse
    {
        forget_all_cache();

        return redirect('/admin/dashboard')
            ->withSuccess(trans('options.cache_deleted'));
    }
}
