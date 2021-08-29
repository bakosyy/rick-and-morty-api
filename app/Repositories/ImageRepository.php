<?php  

namespace App\Repositories;

use App\Models\Image;
use App\Models\Location;
use App\Models\Character;

class ImageRepository
{
    public function store($model, $id, $path)
    {
        return $model::find($id)->image()->create(['path' => $path]);
    }

    public function destroy($id)
    {
        
    }
}