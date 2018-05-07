<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateItemRequest;

class ItemController extends Controller
{
	
    public function index()
    {
        return view('items.index');
	}

    public function create()
    {
		if (! Schema::hasTable('types')) {
			$this->log('Cannot find table "types" in items/create');
			return view('items.create');
		}

        return view('items.create')->withTypes(
			(new Type)->orderBy('name')->get()
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

		return redirect('items')->withSuccess(
			trans('items.item_added')
		);
    }


    public function show(Item $item)
    {
		if (Cookie::get('visited')) {
			if (Cookie::get('visited') == $item->id) {
				return view('items.show')->with([
					'item_id' 	 => $item->id,
					'item_title' => $item->title
				]);
			}
		}
		Cookie::queue('visited', $item->id, 1);
		$item->increment('popular');

		return view('items.show')->with([
			'item_id' 	 => $item->id,
			'item_title' => $item->title
		]);
    }


    public function edit(Item $item)
    {
		if (! Schema::hasTable('types')) {
			$this->log('Cannot find table "types" in items/edit');
			return view('items.create');
		}

		$types = (new Type)->orderBy('name')->get();

		$category = ($item->category === 'men')
			? trans('items.men_items')
			: trans('items.women_items');

        return view('items.edit')->with(compact('item', 'types', 'category'));
    }


    public function update(UpdateItemRequest $request, Item $item)
    {
		if ($request->hasFile('image'))
		{
			if (Storage::exists('public/img/clothes/'.$item->image)) {
				Storage::delete('public/img/clothes/'.$item->image);
			}
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
}
