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
        $cards = cache()->rememberForever('home_cards', function () {
            try {
                return Card::with('type')->get()->take(3)->toArray();
            } catch (QueryException $e) {
                logs()->error($e->getMessage());
                return [];
            }
        });

        $home_sections = cache()->rememberForever('home_sections', function () {
            try {
                return Section::where('name', 'home_up')
                    ->orWhere('name', 'home_down')
                    ->get()
                    ->toArray();
            } catch (QueryException $e) {
                logs()->error($e->getMessage());
                return [];
            }
        });

        return view('pages.home', compact('cards', 'home_sections'));
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
                'result' => (new Item)->getByTitleOrTypeName($request->word),
                'word' => $request->word,
            ]);
        }
        return view('pages.search');
    }
}
