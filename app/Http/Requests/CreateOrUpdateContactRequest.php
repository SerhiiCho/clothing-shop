<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrUpdateContactRequest extends FormRequest
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
            'icon' => 'nullable|numeric|max:20',
            'phone' => 'required|min:10|max:20',
        ];
    }

    // Make custom messages for validation rules
    public function messages()
    {
        return [
            'icon.numeric' => trans('contacts.icon_numeric'),
            'icon.max' => trans('contacts.icon_max'),
            'phone.required' => trans('contacts.phone_required'),
            'phone.max' => trans('contacts.phone_max'),
            'phone.min' => trans('contacts.phone_min'),
        ];
    }
}
