<?php

namespace App\Http\Controllers;

use App\Models\Card;

class PageController extends Controller
{
    public function home()
    {
        $cards = cache()->rememberForever('home_cards', function () {
            return Card::with('type')->get()->take(3)->toArray();
        });

        return view('home', compact('cards'));
    }
}
