<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Type;
use App\Models\ItemsPhoto;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Cookie;
use App\Http\Requests\StoreItemRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateItemRequest;

class ItemController extends Controller
{
	public function __construct()
    {
		$this->middleware('member')->only(['create', 'store']);
        $this->middleware('admin')->only(['edit', 'update']);
	}
	
    public function index()
    {
		$current_category = whatIsCurrent('category');

		if ($current_category === 'women' || $current_category === 'men') {
			$sidebar = true;
		} else {
			$sidebar = false;
		}

        return view('items.index')->with(compact('current_category', 'sidebar'));
	}

    public function create()
    {
        return view('items.create')->withTypes(
			(new Type)->orderBy('name')->get()
		);
    }

    public function store(StoreItemRequest $request)
    {
		$item = auth()->user()->items()->create([
			'title' => $request->title,
			'content' => $request->content,
			'category' => $request->category,
			'price' => $request->price,
			'type_id' => $request->type
		]);

			
		$i = 0;

        foreach ($request->photos as $image) {
			$i++;
			if ($i <= 5) {
				$ext = $image->getClientOriginalExtension();
				$filename = getFileName($request->title, $ext);

				(new ImageManager)->make($image)->resize(451, 676)->save(
					storage_path('app/public/img/clothes/' . $filename
				));

				ItemsPhoto::create([
					'item_id' => $item->id,
					'name' => $filename
				]);
			}
		}

		return redirect('items')->withSuccess(
			trans('items.item_added')
		);
    }


    public function show($category, Item $item)
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
		$types = (new Type)->orderBy('name')->get();

		$category = ($item->category === 'men')
			? trans('items.men_items')
			: trans('items.women_items');

        return view('items.edit')->with(compact('item', 'types', 'category'));
    }


    public function update(UpdateItemRequest $request, Item $item)
    {
		if ($request->hasFile('photos'))
		{
			foreach ($item->photos as $photo) {
				Storage::delete('public/img/clothes/' . $photo->name);
				$photo->delete();
			}
			$i = 0;

			foreach ($request->photos as $image) {
				if ($i <= 5) {
					$ext = $image->getClientOriginalExtension();
					$filename = getFileName($request->title, $ext);
		
					(new ImageManager)->make($image)->resize(451, 676)->save(
						storage_path('app/public/img/clothes/' . $filename
					));

					ItemsPhoto::create([
						'item_id' => $item->id,
						'name' => $filename
					]);
				}
			}
		}

		$item->update([
			'title' => $request->title,
			'content' => $request->content,
			'category' => $request->category,
			'price' => $request->price,
			'type_id' => $request->type
		]);

		return back()->withSuccess(
			trans('items.item_changed')
		);
    }
}
