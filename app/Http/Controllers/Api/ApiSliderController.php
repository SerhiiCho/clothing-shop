<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use App\Models\Slider;

class ApiSliderController extends Controller
{
    // Returns all sliders from database
    public function main()
    {
        return Slider::orderBy('order')->get();
    }

     // Returns 2 random cards for slider
    public function cards()
    {
        $cards = Item::inStock()->inRandomOrder()->take(2)->get();
        return ItemResource::collection($cards);
    }
}
