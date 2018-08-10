<?php

namespace App\Http\Controllers\Api;

use App\Contracts\ItemHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Models\Item;

class ApiItemController extends Controller
{
    use ItemHelpers;

    public function index($category = null, $type = null)
    {
        if ($category && !$type) {
            $query = [['category', $category]];
        } elseif ($category && $type) {
            $query = [['category', $category], ['type_id', $type]];
        } else {
            $query = [];
        }
        return ItemResource::collection(
            Item::where($query)
                ->inStock()
                ->paginate(40)
        );
    }

    public function show(Item $item)
    {
        return new ItemResource($item);
    }

    public function random($category)
    {
        $items = Item::inRandomOrder()
            ->whereCategory($category)
            ->inStock()
            ->take(7)
            ->get();
        return ItemResource::collection($items);
    }

    public function popular()
    {
        $items = Item::inStock()
            ->take(12)
            ->orderBy('popular', 'desc')
            ->get();
        return ItemResource::collection($items);
    }

    public function destroy($id)
    {
        $item = Item::find($id);

        $this->deleteOldPhotos($item->photos);

        if ($item->delete()) {
            return new ItemResource($item);
        }
    }
}
