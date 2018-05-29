<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;

class ApiSliderController extends Controller
{
    public function main()
	{
		return Slider::orderBy('order')->get();
	}

    public function cards()
	{
		$cards = Item::inStock()->inRandomOrder()->take(2)->get();
		return ItemResource::collection($cards);
	}
}
