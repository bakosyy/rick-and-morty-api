<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EpisodeUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $season = $this->season;
        $series = $this->series;
        $id = $this->id;
        
        return [
            'name' => [
                'required', 
                'string', 
                'max:255',
                Rule::unique('episodes', 'name')->ignore($id)
            ],
            'season' => [
                'required',
                'integer',
                Rule::unique('episodes')->where(function ($query) use ($season, $series) {
                    return $query->where('season', $season)->where('series', $series);
                })
            ],
            'series' => ['required', 'integer'],
            'premiere' => ['required', 'date_format:Y-m-d'],
            'description' => ['required', 'between:3,65535']
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Эпизод с таким именем уже существует',
            'season.unique' => 'Уже существует такой сезон и серия'
        ];
    }
}
