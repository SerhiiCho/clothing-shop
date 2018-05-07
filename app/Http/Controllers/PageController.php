<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class PageController extends Controller
{
    public function home() {
		if (Schema::hasTable('cards')) {
			return view('home')->withCards(
				Card::all()->take(3)
			);
		}
		return view('home');
	}

	public function lang($lang) {
		return back()->withCookie(
			cookie('lang', $lang, 518400)
		); // 518400 = 1 year
	}
}