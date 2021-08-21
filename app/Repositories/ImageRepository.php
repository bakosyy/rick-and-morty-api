<?php  

namespace App\Repositories;

use App\Models\Image;

class ImageRepository
{
    public function store($params)
    {
        $image = new Image;
        // Создаем путь до изображения и в то же время сохраняем в storage
        $image->path = asset( '/storage/'. $params['image']->store('images') );
        $image->save();

        return $image;
    }

    public function imageExists($id)
    {
        return !is_null(Image::find($id))
            ? true
            : false;
    }
    
    public function destroy($id)
    {
        Image::find($id)->delete();
    }
}