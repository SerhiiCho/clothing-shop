<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Type;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use App\Http\Requests\StoreCardRequest;

class CardController extends Controller
{
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
			Type::orderBy('type')->get()
		);
    }

    // Store a newly created resource in storage
    public function store(StoreCardRequest $request)
    {
        $image = $request->file('image');
		$ext = $image->getClientOriginalExtension();
		$filename = getFileName($request->type, $ext);
		
		(new ImageManager)->make($image)->resize(300, 400)->save(
			storage_path('app/public/img/cards/' . $filename
		));

		Type::find($request->type)->card()->create([
			'image' => $filename
		]);

		return redirect('cards')->withSuccess(
			trans('cards.card_added')
		);
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
		dd($id);
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        dd($request);
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        dd('yeap ' . $id);
    }
}
