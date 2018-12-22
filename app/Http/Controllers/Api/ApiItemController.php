<?php

namespace App\Http\Controllers\Api;

use App\Contracts\ItemHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Models\Item;

class ApiItemController extends Controller
{
    use ItemHelpers;

    /**
     * @param null|string $category
     * @param null|string $type
     * @return \App\Http\Resources\ItemResource
     */
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
                ->latest()
                ->paginate(40)
        );
    }

    /**
     * @param \App\Models\Item $item
     * @return \App\Http\Resources\ItemResource
     */
    public function show(Item $item)
    {
        return new ItemResource($item);
    }

    /**
     * Get list of random items
     *
     * @param string $category
     */
    public function random($category)
    {
        $items = Item::inRandomOrder()
            ->whereCategory($category)
            ->inStock()
            ->take(7)
            ->get();

        return ItemResource::collection($items);
    }

    /**
     * Get list of popular items
     */
    public function popular()
    {
        $items = Item::inStock()
            ->take(12)
            ->orderBy('popular', 'desc')
            ->get();

        return ItemResource::collection($items);
    }

    /**
     * @param int $id
     */
    public function destroy($id)
    {
        $item = Item::find($id);

        $this->deleteOldPhotos($item->photos);

        cache()->forget('categories_men');
        cache()->forget('categories_women');

        if ($item->delete()) {
            return new ItemResource($item);
        }
    }
}
