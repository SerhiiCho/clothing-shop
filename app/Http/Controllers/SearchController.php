<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Item;
use Illuminate\View\View;

class SearchController extends Controller
{
    /**
     * If queary exist, give result
     * otherwise just return view
     *
     * @param \App\Http\Requests\SearchRequest $request
     * @return \Illuminate\View\View
     */
    public function handleTheRequest(SearchRequest $request): View
    {
        if ($request->has('word')) {
            return view('search', [
                'result' => (new Item)->getByTitleOrTypeName($request->word),
                'word' => $request->word,
            ]);
        }
        return view('search');
    }
}
