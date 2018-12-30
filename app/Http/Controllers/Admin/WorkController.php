<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\View\View;

class WorkController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * @param string|null $tab
     * @return \Illuminate\View\View
     */
    public function index(?string $tab = null): View
    {
        if ($tab && $tab === 'closed') {
            $orders = Order::onlyTrashed()->latest()->paginate(24);
        } else {
            $orders = Order::latest()->paginate(24);
        }

        return view('admin.work.index', compact('orders', 'tab'));
    }
}
