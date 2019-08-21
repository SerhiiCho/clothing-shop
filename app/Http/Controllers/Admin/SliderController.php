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
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(): View
    {
        return view('admin.slider.index', [
            'slider' => Slider::orderBy('order', 'desc')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.slider.create');
    }

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

    public function edit(Slider $slider): View
    {
        return view('admin.slider.edit')->withSlider($slider);
    }

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
     * @param \App\Models\Slider $slider
     * @return \Illuminate\Http\RedirectResponse
     * @see I use observer for this method \App\Observers\SliderObserver
     * @throws \Exception
     */
    public function destroy(Slider $slider): RedirectResponse
    {
        $slider->delete();
        return redirect('/admin/slider')->withSuccess(trans('slider.deleted'));
    }

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
