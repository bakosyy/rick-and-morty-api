<?php

namespace App\Services\v1;

use App\Services\v1\Helper;
use App\Repositories\EpisodeRepository;

class EpisodeService extends BaseService
{
    protected $repo;

    public function __construct()
    {
        $this->repo = new EpisodeRepository();
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
            return $this->errService('Какая-то ошибка');
        }
        return $this->result($model);
    }

    public function get($id)
    {
        $model = $this->repo->get($id);
        if (is_null($model)) {
            return $this->errNotFound('Эпизод не найден');
        }
        return $this->result($model);
    }

    public function update($params, $id)
    {
        $model = $this->repo->get($id);
        if (is_null($model)) {
            return $this->errNotFound('Эпизод не найден');
        }

        $this->repo->update($params, $id);
        return $this->ok('Эпизод обновлен');
    }

    public function destroy($id)
    {
        $model = $this->repo->get($id);
        if (is_null($model)) {
            return $this->errNotFound('Эпизод не найден');
        }

        $this->repo->destroy($id);
        return $this->ok('Эпизод удален');
    }
}