<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Card;
use App\Models\Item;
use App\Models\Section;
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
        try {
            return view('pages.home', [
                'cards' => cache()->rememberForever('home_cards', function () {
                    return Card::getCards();
                }),
                'home_sections' => cache()->rememberForever('home_sections', function () {
                    return Section::where('name', 'home_up')
                        ->orWhere('name', 'home_down')
                        ->get()
                        ->toArray();
                }),
            ]);
        } catch (QueryException $e) {
            no_connection_error($e, __CLASS__);
            return view('pages.home');
        }
    }

    /**
     * If queary exist, give result
     * otherwise just return view
     *
     * @param \App\Http\Requests\SearchRequest $request
     * @return \Illuminate\View\View
     */
    public function search(SearchRequest $request): View
    {
        if ($request->has('word')) {
            return view('pages.search', [
                'result' => Item::getByTitleOrTypeName($request->word),
                'word' => $request->word,
            ]);
        }
        return view('pages.search');
    }
}
