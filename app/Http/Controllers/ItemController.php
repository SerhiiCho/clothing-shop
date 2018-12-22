<?php

namespace App\Http\Controllers;

use App\Contracts\ItemHelpers;
use App\Http\Requests\ItemRequest;
use App\Models\Item;
use App\Models\Type;
use Illuminate\Support\Facades\Cookie;

class ItemController extends Controller
{
    use ItemHelpers;

    public function __construct()
    {
        $this->middleware('admin')->except(['index', 'show']);
    }

    public function index()
    {
        return view('items.index')->with([
            'current_category' => whatIsCurrent('category'),
            'sidebar' => $this->currentStateOfSidebar(whatIsCurrent('category')),
        ]);
    }

    public function create()
    {
        return view('items.create')->withTypes(
            (new Type)->orderBy('name')->get()
        );
    }

    /**
     * @param \App\Http\Requests\ItemRequest $request
     */
    public function store(ItemRequest $request)
    {
        $item = $this->createOrUpdateItem($request);
        $this->uploadPhotos($request, $item->id);

        return redirect('items')->withSuccess(
            trans('items.item_added')
        );
    }

    /**
     * @param string $category
     * @param \App\Models\Item $item
     */
    public function show($category, Item $item)
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

        return view('items.show')->with([
            'item_id' => $item->id,
            'item_title' => $item->title,
        ]);
    }

    /**
     * @param \App\Models\Item $item
     */
    public function edit(Item $item)
    {
        $types = (new Type)->orderBy('name')->get();

        $category = ($item->category === 'men')
        ? trans('items.men_items')
        : trans('items.women_items');

        return view('items.edit')->with(compact('item', 'types', 'category'));
    }

    /**
     * @param \App\Http\Requests\ItemRequest $request
     * @param \App\Models\Item $item
     */
    public function update(ItemRequest $request, Item $item)
    {
        if ($request->hasFile('photos')) {
            $this->deleteOldPhotos($item->photos);
            $this->uploadPhotos($request, $item->id);
        }
        $this->createOrUpdateItem($request, $item);

        return back()->withSuccess(trans('items.item_changed'));
    }
}
