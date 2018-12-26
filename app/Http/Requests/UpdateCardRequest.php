<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCardRequest extends FormRequest
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
        $type_max = config('valid.card.type.max');
        $category_max = config('valid.card.category.max');

        return [
            'type' => "required|numeric|between:1,{$type_max}",
            'category' => "required|max:{$category_max}",
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
            'type.required' => trans('cards.type_required'),
            'category.required' => trans('cards.category_required'),
            'category.max' => trans('cards.category_max'),
            'type.between' => trans('cards.type_between'),
            'type.numeric' => trans('cards.type_numeric'),
        ];
    }
}
