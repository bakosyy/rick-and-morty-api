<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CharacterCollection extends ResourceCollection
{
    // public $preserveKeys = true;
    
    public function toArray($request)
    {
        return [
            "data" => $this->collection
        ];
    }
}
