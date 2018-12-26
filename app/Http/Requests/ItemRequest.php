<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
        $title_min = config('valid.item.title.min');
        $title_max = config('valid.item.title.max');
        $content_min = config('valid.item.content.min');
        $content_max = config('valid.item.content.max');
        $category_max = config('valid.item.category.max');
        $stock_min = config('valid.item.stock.min');
        $stock_max = config('valid.item.stock.max');
        $price_min = config('valid.item.price.min');
        $price_max = config('valid.item.price.max');

        $rules = [
            'title' => "required|min:{$title_min}|max:{$title_max}",
            'content' => "required|min:{$content_min}|max:{$content_max}",
            'category' => "required|max:{$category_max}",
            'type' => 'required',
            'stock' => "required|numeric|between:{$stock_min},{$stock_max}",
            'price' => "required|numeric|digits_between:{$price_min},{$price_max}",
        ];

        if (request()->hasFile('photos')) {
            $photos = count(request('photos'));

            foreach (range(0, $photos) as $i) {
                $rules["photos.$i"] = 'image|nullable|max:1999';
            }
        }
        return $rules;
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'title.required' => trans('items.title_required'),
            'content.required' => trans('items.content_required'),
            'category.required' => trans('items.category_required'),
            'category.max' => trans('items.category_max'),
            'type.required' => trans('items.type_required'),
            'price.required' => trans('items.price_required'),
            'price.digits_between' => trans('items.price_digits_between'),
            'price.numeric' => trans('items.price_numeric'),
            'stock.required' => trans('items.stock_required'),
            'stock.digits_between' => trans('items.stock_digits_between'),
            'stock.numeric' => trans('items.stock_numeric'),
            'title.min' => trans('items.title_min'),
            'content.min' => trans('items.content_min'),
            'title.max' => trans('items.title_max'),
            'content.max' => trans('items.content_max'),
            'photos.image' => trans('items.image_image'),
            'photos.max' => trans('items.image_max'),
        ];
    }
}
