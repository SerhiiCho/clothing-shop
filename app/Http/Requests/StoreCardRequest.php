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
        return [
            'image'  	 => 'required|max:1999',
            'type'		 => 'required|max:30'
        ];
	}
	
	// Custom messages
	public function messages()
    {
        return [
            'image.required' 	=> trans('cards.img_required'),
            'type.required' 	=> trans('cards.type_required'),
            'image.max' 		=> trans('cards.image_max'),
            'type.max' 			=> trans('cards.type_max')
        ];
    }
}
