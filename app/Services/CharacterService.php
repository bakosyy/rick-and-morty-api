<?php

namespace App\Services;

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
        if(is_null($model))
        {
            return $this->errNotFound('Персонаж не найден');
        }
        return $this->result($model);
    }

    public function store($params)
    {
        $model = $this->repo->store($params);
        if(is_null($model)){
            return $this->errService('Ошибка при создании персонажа');
        }
        return $this->ok('Персонаж сохранен');
    }


    public function update($params, $id)
    {
        // Проверка модели на сушествование 
        $model = $this->repo->get($id);
        if(is_null($model)){
            return $this->errNotFound('Не найден персонаж для обновления');
        }

        $this->repo->update($params, $id);
        return $this->ok('Персонаж обновлен');
    }

    public function destroy($id)
    {
        // Проверка модели на сушествование 
        $model = $this->get($id);
        if(is_null($model))
        {
            return $this->errNotFound('Не найден персонаж для удаления');
        }

        $this->repo->destroy($id);
        return $this->ok('Персонаж удален');
    }
}
