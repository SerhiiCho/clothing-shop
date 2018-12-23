<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('admin.dashboard.index', [
            'all_items' => Item::where('stock', '>', 0)->count(),
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function blockRegistration(Request $request): RedirectResponse
    {
        if ($request->has('block') && $request->block === 'on') {
            return redirect('/admin/dashboard')->withSuccess(
                trans('dashboard.registration_disabled')
            );
        }
        return redirect('/admin/dashboard')->withSuccess(
            trans('dashboard.registration_enabled')
        );
    }
}
