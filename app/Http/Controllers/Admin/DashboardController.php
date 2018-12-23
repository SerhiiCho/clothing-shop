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
        $options = Option::get();

        return view('admin.dashboard.index', [
            'all_items' => Item::where('stock', '>', 0)->count(),
            'options' => [
                'registration' => $options->where('option', 'registration')->first()->value,
                'men_category' => $options->where('option', 'men_category')->first()->value,
                'women_category' => $options->where('option', 'women_category')->first()->value,
            ],
        ]);
    }
}
