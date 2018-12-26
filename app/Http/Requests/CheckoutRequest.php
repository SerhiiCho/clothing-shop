<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
        $name_min = config('valid.checkout.name.min');
        $name_max = config('valid.checkout.name.max');
        $phone_min = config('valid.checkout.phone.min');
        $phone_max = config('valid.checkout.phone.max');

        return [
            'name' => "required|min:{$name_min}|max:{$name_max}",
            'phone' => "required|min:{$phone_min}|max:{$phone_max}",
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => trans('checkout.name_required'),
            'phone.required' => trans('checkout.phone_required'),
            'phone.min' => trans('checkout.phone_min'),
            'name.min' => trans('checkout.name_min'),
            'phone.max' => trans('checkout.phone_max'),
            'name.max' => trans('checkout.name_max'),
        ];
    }
}
