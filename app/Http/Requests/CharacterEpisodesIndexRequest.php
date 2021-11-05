<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CharacterEpisodesIndexRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'q' => ['nullable', 'string'],
            'season.*' => ['nullable', 'integer', 'exists:episodes,id'],
            'premiere_from' => ['nullable', 'date', 'date_format:Y-m-d'],
            'premiere_to' => ['nullable', 'date', 'date_format:Y-m-d'],
            'page' => ['nullable', 'integer'],
            'per_page' => ['nullable', 'integer'],
            'sort' => ['nullable', 'in:name,season,series'],
            'sort_way' => ['nullable', 'in:asd,desc,ASC,DESC']
        ];
    }
}
