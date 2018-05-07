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
            'type' => 'required|max:30|numeric'
        ];
	}
	
	// Custom messages
	public function messages()
    {
        return [
            'type.required' 	=> trans('cards.type_required'),
            'type.max' 			=> trans('cards.type_max'),
            'type.numeric' 		=> trans('cards.type_numeric')
        ];
    }
}
