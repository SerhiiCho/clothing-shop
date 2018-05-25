<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCardRequest extends FormRequest
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
            'type' => 'required|digits_between:0,5000|numeric',
            'category' => 'required|max:30',
        ];
	}
	
	// Custom messages
	public function messages()
    {
        return [
            'type.required' => trans('cards.type_required'),
            'category.required' => trans('cards.category_required'),
            'category.max' => trans('cards.category_max'),
            'type.digits_between' => trans('cards.type_digits_between'),
            'type.numeric' => trans('cards.type_numeric')
        ];
    }
}
