<?php

namespace App\Http\Controllers\Api;

use App\Contracts\ItemHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Database\QueryException;

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

        try {
            return ItemResource::collection(
                Item::where($query)
                    ->inStock()
                    ->latest()
                    ->paginate(20)
            );
        } catch (QueryException $e) {
            logs()->error($e->getMessage());
            return collect();
        }
    }

    /**
     * @param string $slug
     * @return \App\Http\Resources\ItemResource
     */
    public function show(string $slug)
    {
        return new ItemResource(Item::whereSlug($slug)->first());
    }

    /**
     * Get list of random items
     *
     * @param string $category
     */
    public function random($category)
    {
        try {
            $items = Item::inRandomOrder()
                ->whereCategory($category)
                ->inStock()
                ->take(7)
                ->get();

            return ItemResource::collection($items);
        } catch (QueryException $e) {
            return collect();
            logs()->error($e->getMessage());
        }
    }

    /**
     * Get list of popular items
     */
    public function popular()
    {
        try {
            $items = Item::inStock()
                ->take(12)
                ->orderBy('popular', 'desc')
                ->get();
            return ItemResource::collection($items);
        } catch (QueryException $e) {
            logs()->error($e->getMessage());
            return collect();
        }
    }

    /**
     * @param string $slug
     */
    public function destroy(string $slug)
    {
        try {
            $item = Item::whereSlug($slug)->first();
        } catch (QueryException $e) {
            logs()->error($e->getMessage());
            return [];
        }

        $this->deleteOldPhotos($item->photos);

        cache()->forget('categories_men');
        cache()->forget('categories_women');

        $item->delete();
        return new ItemResource($item);
    }
}
