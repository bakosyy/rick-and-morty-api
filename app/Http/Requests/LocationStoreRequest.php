<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LocationStoreRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'between:2,255',
                Rule::unique('locations', 'name')
            ],
            'type' => ['required', 'in:universe,planet,sector,base,microuniverse'],
            'dimension' => ['required', 'in:c-137,substituted,5-126'],
            'description' => ['required', 'string', 'between:3,65535']
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Локация с таким именем уже существует'
        ];
    }
}
