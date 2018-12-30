<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
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
        $title_max = config('valid.section.title.max');
        $content_max = config('valid.section.content.max');

        return [
            'title' => "nullable|max:{$title_max}",
            'content' => "nullable|max:{$content_max}",
        ];
    }

    // Custom messages
    public function messages()
    {
        return [
            'title.max' => trans('section.title_max'),
            'content.max' => trans('section.content_max'),
        ];
    }
}
