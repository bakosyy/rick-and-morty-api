<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'phone' => ['required', 'string', 'regex:/^[0-9]*$/', 'between:5,16', 'exists:users,phone'],
            'password' => ['required', 'string'],
            'device_name' => ['required', 'string']
        ];
    }
}