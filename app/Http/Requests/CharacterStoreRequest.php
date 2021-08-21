<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CharacterStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "name" => ["required", "string", "between:2,255", 'unique:characters,name'],
            "status" => ["required", "in:alive,dead"],
            "gender" => ["required", "in:male,female"],
            "race" => ["required", "in:human,alien,robot,humanoid,animal"],
            "description" => ["required", "string", "between:3,65535"]
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Персонаж по такому имени существует'
        ];
    }
}
