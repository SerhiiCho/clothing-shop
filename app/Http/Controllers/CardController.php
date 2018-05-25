<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Type;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use App\Http\Requests\StoreCardRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateCardRequest;

class CardController extends Controller
{
	public function __construct()
    {
        $this->middleware('member')->only(['index', 'create', 'store']);
        $this->middleware('admin')->only(['edit', 'update', 'destroy']);
	}

    // Display a listing of the resource
    public function index()
    {
		return view('cards.index')->withCards(
			Card::all()
		);
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('cards.create')->withTypes(
			Type::orderBy('name')->get()
		);
    }

    // Store a newly created resource in storage
    public function store(StoreCardRequest $request)
    {
		if (Card::count() >= 3) {
			return back()->withError(trans('cards.already_3_cards'));
		}

        $image = $request->file('image');
		$ext = $image->getClientOriginalExtension();
		$filename = getFileName($request->type, $ext);
		
		(new ImageManager)->make($image)->resize(451, 676)->save(
			storage_path('app/public/img/cards/' . $filename
		));

		Card::create([
			'image' => $filename,
			'type_id' => $request->type,
			'category' => $request->category
		]);

		return redirect('cards')->withSuccess(
			trans('cards.card_added')
		);
    }

    // Show the form for editing the specified resource.
    public function edit(Card $card)
    {
		$types = Type::orderBy('name')->get();
		return view('cards.edit')->with(
			compact('card', 'types')
		);
    }

    // Update the specified resource in storage
    public function update(UpdateCardRequest $request, Card $card)
    {
		if ($request->hasFile('image')) {
			Storage::delete('public/img/cards/'.$card->image);
			$image = $request->file('image');
			$ext = $image->getClientOriginalExtension();
			$filename = getFileName($request->type, $ext);
			
			(new ImageManager)->make($image)->resize(451, 676)->save(
				storage_path('app/public/img/cards/' . $filename
			));

			$card->update([ 'image' => $filename ]);
		}
		$card->update([
			'type_id' => $request->type,
			'category' => $request->category
		]);

		return redirect('cards')->withSuccess(
			trans('cards.card_changed')
		);
    }

    /**
	 * Remove the specified resource from storage,
	 * App\Observers\CardObserver will delete image
	 * file while database record is being deleted
	 */
    public function destroy(Card $card)
    {
		return ($card->delete())
			? redirect('cards')->withSuccess(trans('cards.card_deleted'))
			: redirect('cards')->withError(trans('cards.deleted_fail'));
    }
}
