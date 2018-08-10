<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Item;

class SearchController extends Controller
{
    public function handleTheRequest(SearchRequest $request)
    {
        return ($request->has('word'))
        ? view('search')->with([
            'result' => (new Item)->getByTitleOrTypeName($request->word),
            'word' => $request->word,
        ])
        : view('search');
    }
}
