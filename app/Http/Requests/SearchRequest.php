<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    //Determine if the user is authorized to make this request
    public function authorize()
    {
        return true;
    }

    // Get the validation rules that apply to the request
    public function rules()
    {
        return [
            'word' => 'required|max:20',
        ];
    }

    public function messages()
    {
        return [
            'word.required' => trans('search.word_required'),
            'word.max' => trans('search.word_max'),
        ];
    }
}
