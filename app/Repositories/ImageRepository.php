<?php  

namespace App\Repositories;

use App\Models\Image;
use App\Models\Location;
use App\Models\Character;

class ImageRepository
{
    public function store($params, $path)
    {
        $locationId = $params['locationId'] ?? null;
        $characterId = $params['characterId'] ?? null;

        if (!is_null($locationId)) {
            $location = Location::find($locationId);
            $image = new Image;
            $image->path = $path;
;
            $location->image()->save($image);
        }
        if (!is_null($characterId)) {
            $character = Character::find($params['characterId']);
            $image = new Image;
            $image->path = $path;
            
            $character->image()->save($image);
        }
        
        return $image;
    }



    public function imageExists($id)
    {
        $image = Image::find($id);
        if (is_null($image)) {
            return false;
        }
        return true;
    }
    
    public function destroy($id)
    {
        Image::find($id)->delete();
    }
}