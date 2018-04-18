<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home() {
		return view('home');
	}

	public function lang($lang) {
		return back()->withCookie(cookie('lang', $lang, 518400)); // 518400 = 1 year
	}
}