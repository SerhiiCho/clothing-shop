<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('admin.work.index');
    }
}
