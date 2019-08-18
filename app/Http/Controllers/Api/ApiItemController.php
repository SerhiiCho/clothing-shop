<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Traits\ItemHelpers;
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
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
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
     * @param string|null $category
     * @param int $visitor_id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Support\Collection
     */
    public function random(int $visitor_id, ?string $category = null)
    {
        try {
            if ($category) {
                $items = Item::getRandomUnseen($visitor_id, $category);
            } else {
                $items = Item::getRandomUnseen($visitor_id);
            }
            return ItemResource::collection($items);
        } catch (QueryException $e) {
            logs()->error($e->getMessage());
            return collect();
        }
    }

    /**
     * Get list of popular items
     */
    public function popular()
    {
        try {
            $items = Item::inStock()
                ->withCount('views')
                ->take(18)
                ->orderBy('views_count', 'desc')
                ->get();
            return ItemResource::collection($items);
        } catch (QueryException $e) {
            logs()->error($e->getMessage());
            return collect();
        }
    }

    /**
     * @param string $slug
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(string $slug)
    {
        try {
            $item = Item::whereSlug($slug)->first();
        } catch (QueryException $e) {
            no_connection_error($e, __CLASS__);
            return [];
        }

        cache()->forget('footer_latest');
        cache()->forget('categories_men');
        cache()->forget('categories_women');
        cache()->forget('all_women_items');
        cache()->forget('all_men_items');

        $this->deleteOldPhotos($item->photos);

        $item->orders->map(function ($order) use ($item) {
            $order->items()->detach($item->id);
        });
        $item->views()->delete();
        $item->photos()->delete();

        if ($item->delete()) {
            return response(['status' => 'ok'], 200);
        }

        return response(['status' => 'error'], 500);
    }
}
