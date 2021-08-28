<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

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
            'name.unique' => 'Персонаж по такому имени существует',
            'birth_location_id.exists' => 'Неправильное birth_location_id',
            'current_location_id.exists' => 'Неправильное current_location_id',
        ];
    }
}
