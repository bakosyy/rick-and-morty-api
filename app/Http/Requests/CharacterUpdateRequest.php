<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CharacterUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('character');
        return [
            'name' => [
                'required',
                'string',
                'between:2,255',
                Rule::unique('characters', 'name')->ignore($id)
            ],
            'status' => ['required', 'in:alive,dead'],
            'gender' => ['required', 'in:male,female'],
            'race' => ['required', 'in:human,alien,robot,humanoid,animal'],
            'description' => ['required', 'string', 'between:3,65535'],
            'birth_location_id' => [
                'nullable',
                'integer',
                Rule::exists('locations', 'id')->where('deleted_at', NULL)
            ],
            'current_location_id' => [
                'nullable',
                'integer',
                Rule::exists('locations', 'id')->where('deleted_at', NULL)
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Character with this name already exists',
            'birth_location_id.exists' => 'Invalid birth_location_id',
            'current_location_id.exists' => 'Invalid current_location_id',
        ];
    }
}
