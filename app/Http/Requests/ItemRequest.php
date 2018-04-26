<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    // Determine if the user is authorized to make this request.
    public function authorize()
    {
        return true;
    }

    // Get the validation rules that apply to the request.
    public function rules()
    {
        return [
            'title'		 => 'required|min:4|max:80',
            'content'    => 'required|min:4|max:199',
            'category'	 => 'required',
            'type' 		 => 'required',
            'price1' 	 => 'required|numeric',
            'price2' 	 => 'required|numeric',
            'image'		 => 'required|image|nullable|max:1999'
        ];
	}

	public function messages()
    {
        return [
            'title.required' => 'Поле название обязательно для заполнения',
            'content.required' => 'Поле описание обязательно для заполнения',
            'category.required' => 'Поле категория обязательно для заполнения',
            'type.required' => 'Поле тип обязательно для заполнения',
            'image.required' => 'Добавьте изображение',
            'price1.required' => 'Цена обязательна',
            'price2.required' => 'Цена обязательна',
            'title.min' => 'Количество символов в поле название должно быть не менее :min',
            'content.min' => 'Количество символов в поле описание должно быть не менее :min',
            'title.max' => 'Количество символов в поле название не может превышать :max',
            'content.max' => 'Количество символов в поле описание не может превышать :max',
            'price1.numeric' => 'Цена дожна быть числом',
            'price2.numeric' => 'Цена дожна быть числом',
            'image.image' => 'Изображение должно быть jpg разширения, и не более 2MB',
            'image.max' => 'Изображение должно превышать :max кб'
        ];
    }
}
