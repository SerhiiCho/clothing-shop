<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;

class SearchController extends Controller
{
    public function handleTheRequest(SearchRequest $request)
    {
		return ($request->has('word'))
			? view('search')->with([
				'result' => (new Item)->getByTitleOrTypeName($request->word),
				'word' => $request->word
			])
			: view('search');
    }
}
