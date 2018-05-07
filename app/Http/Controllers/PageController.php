<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class PageController extends Controller
{
    public function home() {
		if (! Schema::hasTable('cards')) {
			$this->log('Cannot find table "cards" in home page');
			return view('home');
		}
		return view('home')->withCards(Card::all()->take(3));
	}

	// 518400 = 1 year
	public function lang($lang) {
		return back()->withCookie(cookie('lang', $lang, 518400));
	}
}