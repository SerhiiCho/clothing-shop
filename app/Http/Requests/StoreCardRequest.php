<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCardRequest extends FormRequest
{
    // Determine if the user is authorized to make this request
    public function authorize()
    {
        return true;
    }

    // Get the validation rules that apply to the request
    public function rules()
    {
        $type_max = config('valid.card.type.max');
        $category_max = config('valid.card.category.max');

        return [
            'image' => 'required|max:1999',
            'type' => "required|numeric|between:1,{$type_max}",
            'category' => "required|max:{$category_max}",
        ];
    }

    // Custom messages
    public function messages()
    {
        return [
            'image.required' => trans('cards.img_required'),
            'category.required' => trans('cards.category_required'),
            'category.max' => trans('cards.category_max'),
            'type.required' => trans('cards.type_required'),
            'image.max' => trans('cards.image_max'),
            'type.between' => trans('cards.type_between'),
            'type.numeric' => trans('cards.type_numeric'),
        ];
    }
}
