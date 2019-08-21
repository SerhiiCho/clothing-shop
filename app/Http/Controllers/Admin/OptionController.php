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
            return redirect('/admin/dashboard')->withSuccess(
                trans('options.registration_enabled')
            );
        }

        Option::set('registration', 0);

        return redirect('/admin/dashboard')->withSuccess(
            trans('options.registration_disabled')
        );
    }

    public function menCategory(Request $request): RedirectResponse
    {
        if ($request->has('option') && $request->option === 'on') {
            Option::set('men_category', 1);
            return redirect('/admin/dashboard')->withSuccess(
                trans('options.men_category_enabled')
            );
        }

        Option::set('men_category', 0);

        return redirect('/admin/dashboard')->withSuccess(
            trans('options.men_category_disabled')
        );
    }

    public function womenCategory(Request $request): RedirectResponse
    {
        if ($request->has('option') && $request->option === 'on') {
            Option::set('women_category', 1);
            return redirect('/admin/dashboard')->withSuccess(
                trans('options.women_category_enabled')
            );
        }

        Option::set('women_category', 0);

        return redirect('/admin/dashboard')->withSuccess(
            trans('options.women_category_disabled')
        );
    }

    public function cacheForget(): RedirectResponse
    {
        forget_all_cache();

        return redirect('/admin/dashboard')->withSuccess(
            trans('options.cache_deleted')
        );
    }
}
