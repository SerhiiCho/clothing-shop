<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\View\View;

class TableController extends Controller
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
        $order = request('order') ?? 'id';
        $allowed = ['title', 'id', 'popular', 'stock', 'category', 'price'];

        if (!in_array($order, $allowed)) {
            $order = 'id';
        }

        $items = Item::with('type')
            ->orderBy($order, 'desc')
            ->paginate(70)
            ->onEachSide(1);

        return view('admin.table.index', compact('items', 'order'));
    }
}
