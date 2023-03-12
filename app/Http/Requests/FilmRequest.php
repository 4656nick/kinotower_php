<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'country_id' => 'required|nullable|exists:countries,id',
            'duration' => 'required|max:255',
            'year_of_issue' => 'required|max:255',
            'age' => 'required|max:255',
            'link_img' => 'nullable',
            'link_kinopoisk' => 'nullable',
            'link_video' => 'nullable',
        ];
    }
}