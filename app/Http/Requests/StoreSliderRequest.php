<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSliderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $order_max = config('valid.slider.order.max');

        return [
            'image' => 'required|image|max:1999',
            'order' => "nullable|numeric|max:{$order_max}",
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
