<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home() {
		return view('home')->withCards(
			Card::all()->take(3)
		);
	}

	public function lang($lang) {
		return back()->withCookie(cookie('lang', $lang, 518400)); // 518400 = 1 year
	}
}