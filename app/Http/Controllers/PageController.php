<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;

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
            try {
                return Card::with('type')->get()->take(3)->toArray();
            } catch (QueryException $e) {
                logs()->error($e->getMessage());
                return [];
            }
        });

        return view('home', compact('cards'));
    }
}
