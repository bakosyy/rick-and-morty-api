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
        return [
            'name' => ['required', 'string', 'between:2,255'],
            'status' => ['required', 'in:alive,dead'],
            'gender' => ['required', 'in:male,female'],
            'race' => ['required', 'in:human,alien,robot,humanoid,animal'],
            'description' => ['required', 'string', 'between:3,65535'],
            'birth_location_id' => ['nullable', 'integer', 'exists:locations,id'],
            'current_location_id' => ['nullable', 'integer', 'exists:locations,id'],
        ];
    }
}
