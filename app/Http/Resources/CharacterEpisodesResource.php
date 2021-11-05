<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CharacterEpisodesResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'season' => $this->season,
            'series' => $this->series,
            'premiere' => $this->premiere,
            'description' => $this->description,
            'image' => new ImageResource($this->image)
        ];
    }
}
