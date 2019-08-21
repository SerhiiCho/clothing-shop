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
                'all_first_items' => cache()->rememberForever('all_first_items', function () {
                    return Item::whereCategory('category1')->sum('stock');
                }),
                'all_second_items' => cache()->rememberForever('all_second_items', function () {
                    return Item::whereCategory('category2')->sum('stock');
                }),
            ]);
        } catch (QueryException $e) {
            no_connection_error($e, __CLASS__);
            return view('admin.dashboard.index');
        }
    }
}
