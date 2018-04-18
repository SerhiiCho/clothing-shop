<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;

class ApiItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($sex = null, $category = null)
    {
		if ($sex && $category) {
			$statement = [['sex', $sex], ['category', $category]];
		} elseif ($sex && $category == null) {
			$statement = [['sex', $sex]];
		} else {
			$statement = [['category', '!=', 'null']];
		}

		$items = Item::where($statement)->paginate(20);

		return ItemResource::collection($items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$id = $request->item_id;
		$item = $request->isMethod('put') ? Item::findOrFail($id) : new Item;

		$item->id = $request->input('item_id');
		$item->title = $request->input('title');
		$item->content = $request->input('content');
		$item->sex = $request->input('sex');
		$item->category = $request->input('category');
		$item->price = $request->input('price');
		$item->save();

		return new ItemResource($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$item = Item::findOrFail($id);
		return new ItemResource($item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
		return back();
    }
}
