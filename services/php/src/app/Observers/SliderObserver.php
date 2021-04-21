<?php

namespace App\Observers;

use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class SliderObserver
{
    /**
     * Deleting slide image if slide is being deleted
     *
     * @return void
     */
    public function deleting(Slider $slider): void
    {
        if ($slider->image != 'default.jpg') {
            Storage::delete("public/img/big/slider/{$slider->image}");
        }
    }
}
