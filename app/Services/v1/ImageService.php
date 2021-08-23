<?php

namespace App\Services\v1;

use App\Services\v1\BaseService;
use App\Repositories\ImageRepository;
use Illuminate\Support\Facades\Storage;

class ImageService extends BaseService
{
    protected $repo;

    public function __construct()
    {
        $this->repo = new ImageRepository();
    }

    public function store($params)
    {
        // Сохраняем ихображения
        $path = $params['image']->store('images');

        // Проверить если изображения загрузилась
        if (Storage::missing($path)) {
            return $this->errService('Ошибка при сохранении изображения');
        }

        // Создание записи изображения
        $model = $this->repo->store($path);
        if (is_null($model)) {
            return $this->errService('Ошибка с работой БД');
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
