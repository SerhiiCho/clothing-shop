<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
		$this->middleware('auth')->only(['dashboard']);
        $this->middleware('member')->only(['work']);
	}

	public function dashboard()
	{
		return view('user.dashboard')->with(
			'all_items', Item::where('stock', '>', 0)->count()
		);
	}

	public function work()
	{
		return view('user.work');
	}
}
