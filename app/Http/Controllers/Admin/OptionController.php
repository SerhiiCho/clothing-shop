<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registration(Request $request): RedirectResponse
    {
        if ($request->has('option') && $request->option === 'on') {
            Option::set('registration', 'on');
            return redirect('/admin/dashboard')->withSuccess(
                trans('options.registration_enabled')
            );
        }

        Option::set('registration', 'off');

        return redirect('/admin/dashboard')->withSuccess(
            trans('options.registration_disabled')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function menCategory(Request $request): RedirectResponse
    {
        if ($request->has('option') && $request->option === 'on') {
            Option::set('men_category', 'on');
            return redirect('/admin/dashboard')->withSuccess(
                trans('options.men_category_enabled')
            );
        }

        Option::set('men_category', 'off');

        return redirect('/admin/dashboard')->withSuccess(
            trans('options.men_category_disabled')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function womenCategory(Request $request): RedirectResponse
    {
        if ($request->has('option') && $request->option === 'on') {
            Option::set('women_category', 'on');
            return redirect('/admin/dashboard')->withSuccess(
                trans('options.women_category_enabled')
            );
        }

        Option::set('women_category', 'off');

        return redirect('/admin/dashboard')->withSuccess(
            trans('options.women_category_disabled')
        );
    }
}
