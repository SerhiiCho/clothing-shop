<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'name' => 'required|min:3|max:30',
            'phone' => 'required|min:10|max:30|unique:messages',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('checkout.name_required'),
            'phone.required' => trans('checkout.phone_required'),
            'phone.min' => trans('checkout.phone_min'),
            'name.min' => trans('checkout.name_min'),
            'phone.max' => trans('checkout.phone_max'),
            'phone.unique' => trans('checkout.phone_unique'),
            'name.max' => trans('checkout.name_max'),
        ];
    }
}
