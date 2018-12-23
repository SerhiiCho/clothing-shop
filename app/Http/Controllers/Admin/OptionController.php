<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registration(Request $request): RedirectResponse
    {
        if ($request->has('block') && $request->block === 'on') {
            return redirect('/admin/dashboard')->withSuccess(
                trans('options.registration_disabled')
            );
        }
        return redirect('/admin/dashboard')->withSuccess(
            trans('options.registration_enabled')
        );
    }
}
