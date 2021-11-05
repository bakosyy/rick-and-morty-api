<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CharacterSetImageRequest extends FormRequest
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
            'id' => [
                'required',
                'integer',
                Rule::exists('characters', 'id')->where('deleted_at', NULL)
            ],
            'image' => ['required', 'image', 'mimetypes:image/jpeg,image/png', 'between:1,2048'],
        ];
    }
}
