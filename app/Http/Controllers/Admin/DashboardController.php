<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Database\QueryException;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(): View
    {
        try {
            return view('admin.dashboard.index', [
                'all_men_items' => cache()->rememberForever('all_men_items', function () {
                    return Item::whereCategory('men')->sum('stock');
                }),
                'all_women_items' => cache()->rememberForever('all_women_items', function () {
                    return Item::whereCategory('women')->sum('stock');
                }),
            ]);
        } catch (QueryException $e) {
            no_connection_error($e, __CLASS__);
            return view('admin.dashboard.index');
        }
    }
}
