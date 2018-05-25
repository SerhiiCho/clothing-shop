<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use Illuminate\Support\Facades\Storage;

class ApiItemController extends Controller
{
    public function index($category = null, $type = null)
    {
		if ($category && !$type) {
			$items = Item::where('category', $category)->paginate(40);
		} elseif ($category && $type) {
			$items = Item::where([['category', $category], ['type_id', $type]])->paginate(40);
		} else {
			$items = Item::paginate(40);
		}
		return ItemResource::collection($items);
	}


    public function show(Item $item)
    {
		return new ItemResource($item);
	}


    public function random($category)
    {
		$items = Item::inRandomOrder()
			->whereCategory($category)
			->take(7)
			->get();
		return ItemResource::collection($items);
	}


    public function popular()
    {
		$items = Item::take(12)->orderBy('popular', 'desc')->get();
		return ItemResource::collection($items);
	}


    public function destroy($id)
    {
		$item = Item::find($id);

		foreach ($item->photos as $photo) {
			if ($photo->name != 'default.jpg') {
				Storage::delete('public/img/clothes/' . $photo->name);
				$photo->delete();
			}
		}

		if ($item->delete()) {
			return new ItemResource($item);
		}
    }
}
