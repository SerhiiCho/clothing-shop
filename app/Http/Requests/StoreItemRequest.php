<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
{
    // Determine if the user is authorized to make this request.
    public function authorize()
    {
        return true;
    }

    // Get the validation rules that apply to the request.
    public function rules()
    {
		$rules = [
			'title' => 'required|min:4|max:80',
			'content' => 'required|min:4|max:3000',
			'category' => 'required|max:20',
			'type' => 'required',
			'price' => 'required|numeric|digits_between:2,6'
		];
		
		if (request()->hasFile('photos')) {
			$photos = count(request('photos'));

			foreach(range(0, $photos) as $i) {
				$rules['photos.' . $i] = 'image|nullable|max:1999';
			}
		} else {
			$rules['photos'] = 'required';
		}

        return $rules;
	}

	// Custom messages
	public function messages()
    {
        return [
            'title.required' => trans('items.title_required'),
            'content.required' => trans('items.content_required'),
            'category.required' => trans('items.category_required'),
            'category.max' => trans('items.category_max'),
            'type.required' => trans('items.type_required'),
            'photos.required' => trans('items.image_required'),
            'price.required' => trans('items.price_required'),
            'price.digits_between' => trans('items.price_digits_between'),
            'title.min' => trans('items.title_min'),
            'content.min' => trans('items.content_min'),
            'title.max' => trans('items.title_max'),
            'content.max' => trans('items.content_max'),
            'price.numeric' => trans('items.price_numeric'),
            'photos.image' => trans('items.image_image'),
            'photos.max' => trans('items.image_max')
        ];
    }
}
