<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Option;
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
        $registration = Option::whereOption('registration')->value('value');

        return view('admin.dashboard.index', [
            'all_items' => Item::where('stock', '>', 0)->count(),
            'registration' => $registration === 'on' ? true : false,
        ]);
    }
}
