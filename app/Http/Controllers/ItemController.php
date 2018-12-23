<?php

namespace App\Http\Controllers;

use App\Contracts\ItemHelpers;
use App\Http\Requests\ItemRequest;
use App\Models\Item;
use App\Models\Type;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cookie;
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
            'current_category' => whatIsCurrent('category'),
            'sidebar' => $this->currentStateOfSidebar(whatIsCurrent('category')),
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
        $item = $this->createOrUpdateItem($request);

        $image_names = $this->uploadPhotos($request, $item->id);
        $this->updateImagesInDb($image_names, $item->id);

        return redirect('items')->withSuccess(
            trans('items.item_added')
        );
    }

    /**
     * @param string $category
     * @param \App\Models\Item $item
     * @return \Illuminate\View\View
     */
    public function show($category, Item $item): View
    {
        // If page has been just visited just return view
        if (Cookie::get('visited') && Cookie::get('visited') == $item->id) {
            return view('items.show')->with([
                'item_id' => $item->id,
                'item_title' => $item->title,
            ]);
        }

        Cookie::queue('visited', $item->id, 1);
        $item->increment('popular');

        return view('items.show', [
            'item_id' => $item->id,
            'item_title' => $item->title,
        ]);
    }

    /**
     * Show page with form
     *
     * @param \App\Models\Item $item
     * @return \Illuminate\View\View
     */
    public function edit(Item $item): View
    {
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
     * @param \App\Models\Item $item
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ItemRequest $request, Item $item): RedirectResponse
    {
        if ($request->hasFile('photos')) {
            $this->deleteOldPhotos($item->photos);
            $image_names = $this->uploadPhotos($request, $item->id);
            $this->updateImagesInDb($image_names, $item->id);
        }

        $this->createOrUpdateItem($request, $item);

        return back()->withSuccess(trans('items.item_changed'));
    }
}
