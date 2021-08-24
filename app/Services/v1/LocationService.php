<?php

namespace App\Services\v1;

use App\Repositories\LocationRepository;

class LocationService extends BaseService
{
    protected $repo;
    public function __construct()
    {
        $this->repo = new LocationRepository();
    }

    public function index($params)
    {
        $collection = $this->repo->indexPaginate($params);

        return $this->result($collection);
    }

    public function store($params)
    {
        $model = $this->repo->store($params);

        if (is_null($model)) {
            return $this->errService('Ошибка при создании локации');
        }

        if ($this->repo->existsLocation($params['name'])) {
            return $this->errValidate('Локация с таким именем уже существует');
        }

        return $this->ok('Локация создана');
    }

    public function get($id)
    {
        $model = $this->repo->get($id);

        if (is_null($model)) {
            return $this->errNotFound('Локация не найдено');
        }

        return $this->result($model);
    }

    public function update($params, $id)
    {
        /**
         * Существует ли локация по ID
         */
        $location = $this->repo->get($id);
        if (is_null($location)) {
            return $this->errNotFound('Локация для обновляения не найдено');
        }

        if ($this->repo->existsLocation($params['name'], $id)) {
            return $this->errValidate('Локация с таким именем уже существует');
        }

        $this->repo->update($params, $id);
        return $this->ok("Локация обновлена");
    }

    public function destroy($id)
    {
        /**
         * Существует ли локация по ID
         */
        $location = $this->repo->get($id);
        if (is_null($location)) {
            return $this->errNotFound('Локация для удаления не найдено');
        }

        $this->repo->destroy($id);
        return $this->ok("Локация удалена");
    }
}
