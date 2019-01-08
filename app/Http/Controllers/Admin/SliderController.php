<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\ImageManager;

class SliderController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Show page with all sliders
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('admin.slider.index', [
            'slider' => Slider::orderBy('order', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.slider.create');
    }

    /**
     * Store new slider in database
     *
     * @param \App\Http\Requests\liderRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SliderRequest $request): RedirectResponse
    {
        $img = $request->file('image');

        if ($img) {
            $ext = $img->getClientOriginalExtension();
            $filename = get_file_name('slider', $ext);

            $this->uploadImageInStorage($img, $filename);
        }

        Slider::create([
            'image' => $img ? $filename : 'default.jpg',
            'order' => $request ? $request->order : '',
        ]);

        return redirect('/admin/slider')->withSuccess(
            trans('slider.slide_added')
        );
    }

    /**
     * Show the form for editing slider resource
     *
     * @param \App\Models\Slider $slider
     * @return \Illuminate\View\View
     */
    public function edit(Slider $slider): View
    {
        return view('admin.slider.edit')->withSlider($slider);
    }

    /**
     * Update the slider in database
     *
     * @param \App\Http\Requests\SliderRequest $request
     * @param \App\Models\Slider $slider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SliderRequest $request, Slider $slider): RedirectResponse
    {
        if ($request->hasFile('image')) {
            if ($slider->image != 'default.jpg' && $slider->image != 'slider.png') {
                Storage::delete("public/img/big/slider/{$slider->image}");
            }

            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $filename = get_file_name('slider', $ext);

            $this->uploadImageInStorage($image, $filename);

            $slider->update(['image' => $filename]);
        }
        $slider->update(['order' => $request->order]);

        return redirect('/admin/slider')->withSuccess(
            trans('slider.slider_changed')
        );
    }

    /**
     * Remove slider from database
     *
     * @see I use observer for this method \App\Observers\SliderObserver
     * @param \App\Models\Slider $slider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Slider $slider): RedirectResponse
    {
        $slider->delete();
        return redirect('/admin/slider')->withSuccess(trans('slider.deleted'));
    }

    /**
     * Method helper for uploading image in storage
     *
     * @param \Illuminate\Http\UploadedFile $image_inst
     * @param string $filename
     * @return void
     */
    public function uploadImageInStorage(UploadedFile $image_inst, string $filename): void
    {
        (new ImageManager)
            ->make($image_inst)
            ->fit(1000, 500, function ($constraint) {
                $constraint->upsize();
            }, 'top')
            ->save(storage_path("app/public/img/big/slider/{$filename}"));
    }
}
