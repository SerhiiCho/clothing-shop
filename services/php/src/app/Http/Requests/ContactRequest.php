<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
        $icon_max = config('valid.contact.icon.max');
        $phone_min = config('valid.contact.phone.min');
        $phone_max = config('valid.contact.phone.max');

        return [
            'icon' => "nullable|numeric|between:1,{$icon_max}",
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
            'icon.numeric' => trans('contacts.icon_numeric'),
            'icon.between' => trans('contacts.icon_between'),
            'phone.required' => trans('contacts.phone_required'),
            'phone.max' => trans('contacts.phone_max'),
            'phone.min' => trans('contacts.phone_min'),
        ];
    }
}
