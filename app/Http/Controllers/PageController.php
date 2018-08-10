<?php

namespace App\Http\Controllers;

use App\Models\Card;

class PageController extends Controller
{
    public function home()
    {
        return view('home')->withCards(Card::all()->take(3));
    }

    // 518400 = 1 year
    public function lang($lang)
    {
        return back()->withCookie(cookie('lang', $lang, 518400));
    }
}
