<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
        $rules = [
            'order' => "nullable|numeric|max:{$order_max}",
        ];

        if (request()->hasFile('image')) {
            $rules['image'] = ['image'];
        }

        return $rules;
    }

    // Custom messages
    public function messages()
    {
        return [
            'image.image' => trans('slider.image_image'),
            'order.numeric' => trans('slider.order_numeric'),
            'order.max' => trans('slider.order_max'),
        ];
    }
}
