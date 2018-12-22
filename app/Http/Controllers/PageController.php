<?php

namespace App\Http\Controllers;

use App\Models\Card;

class PageController extends Controller
{
    public function home()
    {
        return view('home')->withCards(Card::all()->take(3));
    }
}
