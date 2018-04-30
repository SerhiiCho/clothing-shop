<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use Intervention\Image\ImageManager;
use App\Http\Requests\UpdateItemRequest;

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
		$ext = $image->getClientOriginalExtension();
		$filename = getFileName($request->title, $ext);
		
		(new ImageManager)->make($image)->resize(303, 437)->save(
			storage_path('app/public/img/clothes/' . $filename
		));

		auth()->user()->items()->create([
			'title' => $request->title,
			'content' => $request->content,
			'category' => $request->category,
			'price1' => $request->price1,
			'price2' => $request->price2,
			'image' => $filename,
			'type_id' => $request->type
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
		$types = (new Type)->orderBy('type')->get();

		$category = ($item->category === 'men')
			? trans('items.men_items')
			: trans('items.women_items');

        return view('items.edit')->with(compact('item', 'types', 'category'));
    }


    public function update(UpdateItemRequest $request, Item $item)
    {
		if ($request->hasFile('image'))
		{
			$image = $request->file('image');
			$ext = $image->getClientOriginalExtension();
			$filename = getFileName($request->title, $ext);
			
			(new ImageManager)->make($image)->resize(303, 437)->save(
				storage_path('app/public/img/clothes/' . $filename
			));

			$item->update(['image' => $filename]);
		}

		$item->update([
			'title' => $request->title,
			'content' => $request->content,
			'category' => $request->category,
			'price1' => $request->price1,
			'price2' => $request->price2,
			'type_id' => $request->type
		]);

		return back()->withSuccess(
			trans('items.item_added')
		);
    }


    public function destroy(Item $item)
    {
        //
    }
}
