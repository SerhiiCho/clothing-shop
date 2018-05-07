<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class SliderController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
		if (! Schema::hasTable('slider')) {
			$this->log('Cannot find table "slider" in slider/index');
			return view('slider.index');
		}
        return view('slider.index')->withSlider(Slider::all());
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('slider.create');
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        //
    }

    // Show the form for editing the specified resource
    public function edit(Slider $slider)
    {
		if (! Schema::hasTable('slider')) {
			$this->log('Cannot find table "slider" in slider/create');
			return view('slider.create');
		}
        return view('slider.create')->withSlider($slider);
    }

    // Update the specified resource in storage
    public function update(Request $request, Slider $slider)
    {
        //
    }

    // Remove the specified resource from storage
    public function destroy(Slider $slider)
    {
        //
    }
}
