<?php  

namespace App\Repositories;

use App\Models\Image;

class ImageRepository
{
    public function store($path)
    {
        $image = new Image;
        // Создаем путь до изображения и в то же время сохраняем в storage
        $image->path = $path;
        $image->save();

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