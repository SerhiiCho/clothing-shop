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

    public function index(?string $category = null, ?string $type = null)
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
                Item::with('photos')
                    ->where($query)
                    ->inStock()
                    ->latest()
                    ->paginate(20)
            );
        } catch (QueryException $e) {
            logs()->error($e->getMessage());
            return collect();
        }
    }

    public function show(string $slug)
    {
        return new ItemResource(Item::whereSlug($slug)->first());
    }

    public function random(int $visitor_id, ?string $category = null)
    {
        try {
            $items = $category
                ? Item::getRandomUnseen($visitor_id, $category)
                : Item::getRandomUnseen($visitor_id);

            return ItemResource::collection($items);
        } catch (QueryException $e) {
            logs()->error($e->getMessage());
            return collect();
        }
    }

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

    public function destroy(string $slug)
    {
        try {
            $item = Item::whereSlug($slug)->first();
        } catch (QueryException $e) {
            no_connection_error($e, __CLASS__);
            return [];
        }

        cache()->forget('footer_latest');
        cache()->forget('categories1');
        cache()->forget('categories2');
        cache()->forget('all_second_items');
        cache()->forget('all_first_items');

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
