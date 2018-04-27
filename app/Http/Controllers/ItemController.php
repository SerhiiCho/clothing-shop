<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use Intervention\Image\ImageManager;

class ItemController extends Controller
{
	
    public function index()
    {
        return view('items.index');
	}

    public function create()
    {
        return view('items.create')->withTypes(
			(new Type)->orderBy('type')->get()
		);
    }

    public function store(ItemRequest $request)
    {
		$image = $request->file('image');
		$filename = str_slug($request->title) . '-' . time() . '.' . $image->getClientOriginalExtension();
		
		(new ImageManager)->make($image)->resize(303, 437)->save(
			storage_path('app/public/img/clothes/' . $filename
		));

		Item::create([
			'title' => $request->title,
			'content' => $request->content,
			'category' => $request->category,
			'price' => $request->price1 . '.' . $request->price2,
			'image' => $filename,
			'type_id' => $request->type,
			'user_id' => auth()->user()->id
		]);

		return back()->withSuccess(
			trans('items.item_added')
		);
    }


    public function show(Item $item)
    {
        return view('items.show');
    }


    public function edit(Item $item)
    {
        return view('items.edit');
    }


    public function update(Request $request, Item $item)
    {
        //
    }


    public function destroy(Item $item)
    {
        //
    }
}
