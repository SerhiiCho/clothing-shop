<?php

namespace App\Http\Controllers;

use App\Helpers\Traits\ItemHelpers;
use App\Http\Requests\ItemRequest;
use App\Models\Item;
use App\Models\Option;
use App\Models\Type;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ItemController extends Controller
{
    use ItemHelpers;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin')->except(['index', 'show']);
    }

    public function index(): View
    {
        $category = get_current_category(request()->url());

        return view('items.index')->with([
            'current_category' => $category,
            'sidebar' => $this->currentStateOfSidebar($category),
        ]);
    }

    public function create(): View
    {
        return view('items.create')->withTypes(
            (new Type)->orderBy('name')->get()
        );
    }

    public function store(ItemRequest $request): RedirectResponse
    {
        $this->forgetCache();

        $item = $this->createOrUpdateItem($request);

        $image_names = $this->uploadPhotos($request);
        $this->updateImagesInDb($image_names, $item);

        return redirect('items')->withSuccess(
            trans('items.item_added')
        );
    }

    public function show(string $category, string $slug): View
    {
        $item = Item::whereSlug($slug)->first();

        // Mark that visitor saw the item if he didn't
        if ($item->views()->whereVisitorId(visitor_id())->doesntExist()) {
            try {
                $item->views()->create(['visitor_id' => visitor_id()]);
            } catch (QueryException $e) {
                logger()->error("Cant add visitor view to item. {$e->getMessage()}");
            }
        }

        return view('items.show', [
            'item_slug' => $item->slug,
            'item_category' => $item->category,
            'item_title' => $item->title,
        ]);
    }

    public function edit(string $slug): View
    {
        $item = Item::whereSlug($slug)->first();
        $category = Option::get()->where('option', "{$item->category}_title")->first()->value;
        $types = (new Type)->orderBy('name')->get();

        return view('items.edit')->with(compact('item', 'types', 'category'));
    }

    public function update(ItemRequest $request, string $slug): RedirectResponse
    {
        $this->forgetCache();
        $item = Item::whereSlug($slug)->first();

        if ($request->hasFile('photos')) {
            $this->deleteOldPhotos($item->photos);
            $image_names = $this->uploadPhotos($request);
            $this->updateImagesInDb($image_names, $item);
        }

        $this->createOrUpdateItem($request, $item);

        return back()->withSuccess(trans('items.item_changed'));
    }

    public function forgetCache(): void
    {
        cache()->forget('footer_latest');
        cache()->forget('categories1');
        cache()->forget('categories2');
        cache()->forget('all_second_items');
        cache()->forget('all_first_items');
    }
}
