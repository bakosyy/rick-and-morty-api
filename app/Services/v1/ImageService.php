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
        $locationId = $params['locationId'] ?? null;
        $characterID = $params['characterId'] ?? null;
        
        /**
         * Возвращаем валид. ошибку при наличии обоих characterId и locationId
         */
        if (!is_null($locationId) AND !is_null($characterID)) {
            return $this->errValidate('Нельзя передать обеих locationId и characterId');
        }

        /**
         * Сохраняем ихображение и проверяем что загрузилось
         */
        $path = $params['image']->store('images');
        if (Storage::missing($path)) {
            return $this->errService('Ошибка при сохранении изображения');
        }

        /**
         * Создание записи изображения
         */
        $model = $this->repo->store($params ,$path);
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
