<?php

namespace App\Http\Controllers;

use App\Helpers\Traits\ItemHelpers;
use App\Http\Requests\ItemRequest;
use App\Models\Item;
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

    /**
     * Show page with all items
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('items.index')->with([
            'current_category' => what_is_current('category'),
            'sidebar' => $this->currentStateOfSidebar(what_is_current('category')),
        ]);
    }

    /**
     * Show page with form for creating a new item
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('items.create')->withTypes(
            (new Type)->orderBy('name')->get()
        );
    }

    /**
     * Create new item in database
     *
     * @param \App\Http\Requests\ItemRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ItemRequest $request): RedirectResponse
    {
        cache()->forget('footer_latest');

        $item = $this->createOrUpdateItem($request);

        $image_names = $this->uploadPhotos($request, $item->id);
        $this->updateImagesInDb($image_names, $item->id);

        return redirect('items')->withSuccess(
            trans('items.item_added')
        );
    }

    /**
     * @param string $category
     * @param string $slug
     * @return \Illuminate\View\View
     */
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

    /**
     * Show page with form
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function edit(string $slug): View
    {
        $item = Item::whereSlug($slug)->first();
        $types = (new Type)->orderBy('name')->get();

        $category = ($item->category === 'men')
        ? trans('items.men_items')
        : trans('items.women_items');

        return view('items.edit')->with(compact('item', 'types', 'category'));
    }

    /**
     * Update specific item
     *
     * @param \App\Http\Requests\ItemRequest $request
     * @param string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ItemRequest $request, string $slug): RedirectResponse
    {
        cache()->forget('footer_latest');

        $item = Item::whereSlug($slug)->first();

        if ($request->hasFile('photos')) {
            $this->deleteOldPhotos($item->photos);
            $image_names = $this->uploadPhotos($request, $item->id);
            $this->updateImagesInDb($image_names, $item->id);
        }

        $this->createOrUpdateItem($request, $item);

        return back()->withSuccess(trans('items.item_changed'));
    }
}
