<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationIndexRequest extends FormRequest
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
            'q' => ['nullable', 'string', 'max:255'],
            'type.*' => ['nullable', 'in:universe,planet,sector,base,microuniverse'],
            'dimension.*' => ['nullable', 'in:c-137,substituted,5-126'],
            'page' => ['nullable', 'integer'],
            'per_page' => ['nullable', 'integer'],
            'sort' => ['nullable', 'in:name,description,type,dimension'],
            'sort_way' => ['nullable', 'in:asc,desc,ASC,DESC']
        ];
    }
}
