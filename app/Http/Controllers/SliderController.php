<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateSliderRequest;
use App\Http\Requests\StoreSlideImageRequest;

class SliderController extends Controller
{
	public function __construct()
    {
		$this->middleware('auth');
	}

    public function index()
    {
        return view('slider.index')->withSlider(Slider::all());
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('slider.create');
    }

    // Store a newly created resource in storage
    public function store(StoreSlideImageRequest $request)
    {
		$image = $request->file('image');
		$ext = $image->getClientOriginalExtension();
		$filename = getFileName('slider', $ext);

		(new ImageManager)->make($image)->resize(1000, 500)->save(
			storage_path('app/public/img/slider/' . $filename
		));

		Slider::create([
			'image' => $filename,
			'order' => $request ? $request->order : ''
		]);
		
		return redirect('slider')->withSuccess(
			trans('slider.slide_added')
		);
    }

    // Show the form for editing the specified resource
    public function edit(Slider $slider)
    {
        return view('slider.edit')->withSlider($slider);
    }

    // Update the specified resource in storage
    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        if ($request->hasFile('image')) {
			Storage::delete('public/img/slider/'.$slider->image);
			$image = $request->file('image');
			$ext = $image->getClientOriginalExtension();
			$filename = getFileName('slider', $ext);
			
			(new ImageManager)->make($image)->resize(1000, 500)->save(
				storage_path('app/public/img/slider/' . $filename
			));

			$slider->update([ 'image' => $filename ]);
		}
		$slider->update([ 'order' => $request->order ]);

		return redirect('slider')->withSuccess(
			trans('slider.slider_changed')
		);
    }

    // Remove the specified resource from storage
    public function destroy(Slider $slider)
    {
		$slider->delete();
		return redirect('slider')->withSuccess(trans('slider.deleted'));
    }
}
