<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EpisodeCharacterIndexRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'q' => ['nullable', 'string', 'max:255'],
            'status.*' => ['nullable', 'in:alive,dead'],
            'gender.*' => ['nullable', 'in:male,female'],
            'race.*' => ['nullable', 'in:human,alien,robot,humanoid,animal'],
            'page' => ['nullable', 'integer'],
            'per_page' => ['nullable', 'integer'],
            'sort' => ['nullable', 'string', 'in:name,status,gender,race'],
            'sort_way' => ['nullable', 'string', 'in:asc,desc,ASC,DESC']
        ];
    }
}
