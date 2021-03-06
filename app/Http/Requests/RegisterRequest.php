<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'between:3,25'],
            'phone' => ['required', 'string', 'regex:/^[0-9]*$/', 'between:5,16', 'unique:users,phone'],
            'password' => ['required', 'string', 'between:8,30']
        ];
    }
}
