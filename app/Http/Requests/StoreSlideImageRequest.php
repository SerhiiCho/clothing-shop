<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSlideImageRequest extends FormRequest
{
    // Determine if the user is authorized to make this request
    public function authorize()
    {
        return true;
    }

    // Get the validation rules that apply to the request
    public function rules()
    {
        return [
            'image' => 'required|image|max:1999',
            'order' => 'nullable|numeric|max:99',
        ];
    }

    // Custom messages
    public function messages()
    {
        return [
            'image.required' => trans('slider.image_required'),
            'image.image' => trans('slider.image_image'),
            'image.max' => trans('slider.image_max'),
            'order.numeric' => trans('slider.order_numeric'),
            'order.max' => trans('slider.order_max'),
        ];
    }
}
