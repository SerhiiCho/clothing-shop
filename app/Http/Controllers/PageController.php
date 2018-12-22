<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    /**
     * Display starting home page
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function home(): View
    {
        $cards = cache()->rememberForever('home_cards', function () {
            return Card::with('type')->get()->take(3)->toArray();
        });

        return view('home', compact('cards'));
    }
}
