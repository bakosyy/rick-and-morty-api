<?php

namespace App\Services\v1;

use App\Http\Requests\CharacterRequest;
use App\Models\Character;
use App\Repositories\CharacterRepository;
use App\Services\v1\BaseService;

class CharacterService extends BaseService
{
    protected $repo;

    public function __construct()
    {
        $this->repo = new CharacterRepository;
    }

    public function indexPaginate($params)
    {
        return $this->result($this->repo->indexPaginate($params));
    }

    public function get($id)
    {
        $model = $this->repo->get($id);
        if (is_null($model)) {
            return $this->errNotFound('Персонаж не найден');
        }
        return $this->result($model);
    }

    public function store($params)
    {
        /**
         * Изображение присвоено другому персонажу?
         */
        $isImageUsed = $this->repo->imageUsedbyCharacter($params['image_id']);
        if (!empty($isImageUsed)) {
            return $this->errValidate('Картинка уже присвоено другому персонажу');
        }
        
        $model = $this->repo->store($params);
        if (is_null($model)) {
            return $this->errService('Ошибка при создании персонажа');
        }
        return $this->ok('Персонаж сохранен');
    }


    public function update($params, $id)
    {
        /**
         * Существует ли модель?
         */
        $model = $this->repo->get($id);
        if (is_null($model)) {
            return $this->errNotFound('Не найден персонаж для обновления');
        }

        /**
         * Изображение присвоено другому персонажу?
         */
        $isImageUsed = $this->repo->imageUsedbyCharacter($params['image_id'], $id);
        if (!empty($isImageUsed)) {
            return $this->errValidate('Картинка уже присвоено другому персонажу');
        }
        
        /**
         * Есть ли уже персонаж с таким именем? 
         */
        if ($this->repo->existsName($params['name'], $id)) {
            return $this->errValidate('Другой персонаж с таким именем уже существует');
        }

        $this->repo->update($params, $id);
        return $this->ok('Персонаж обновлен');
    }

    public function destroy($id)
    {
        // Проверка персонажа на сушествование 
        $model = $this->get($id);
        if (is_null($model)) {
            return $this->errNotFound('Не найден персонаж для удаления');
        }

        $this->repo->destroy($id);
        return $this->ok('Персонаж удален');
    }
}
