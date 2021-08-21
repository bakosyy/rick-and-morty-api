<?php 

namespace App\Services;

use App\Services\v1\BaseService;
use App\Repositories\ImageRepository;

class ImageService extends BaseService
{
    protected $repo;

    public function __construct()
    {
        $this->repo = new ImageRepository();
    }

    public function store($params)
    {
        $model = $this->repo->store($params);

        if(is_null($model)){
            return $this->errService('Ошибка при сохранении изображения');
        }
        return $this->result($model);
    }
    
    public function destroy($id)
    {
        if (!$this->repo->imageExists($id)) {
            return $this->errNotFound('Изображение не найдено');
        }
        $this->repo->destroy($id);
        return $this->ok('Изображение удалено');
    }
}