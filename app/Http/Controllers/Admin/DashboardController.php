<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
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
}
