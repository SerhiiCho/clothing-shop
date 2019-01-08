<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Order;
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
            'all_men_items' => Item::whereCategory('men')->sum('stock'),
            'all_women_items' => Item::whereCategory('women')->sum('stock'),
        ]);
    }
}
