<?php

namespace App\Services\v1;

use App\Services\v1\Helper;
use App\Repositories\EpisodeRepository;
use Illuminate\Support\Facades\Storage;
use App\Repositories\CharacterRepository;

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

    public function addEpisodeCharacter($params, $episodeId)
    {
        $model = $this->repo->get($episodeId);
        if (is_null($model)) {
            return $this->errNotFound('Эпизод не найден');
        }

        $check = $this->repo->characterExistsInEpisode($params['character_id'], $episodeId);
        if ($check == true) {
            return $this->errValidate('Персонаж существует в эпизоде');
        }

        $this->repo->addEpisodeCharacter($params, $episodeId);
        return $this->ok('Персонаж добавлен к эпизоду');
    }

    public function getEpisodeCharacters($id)
    {
        $model = $this->repo->get($id);
        if (is_null($id)) {
            return $this->errNotFound('Эпизод не найден');
        }

        $characters = $this->repo->getEpisodeCharacters($id);
        return $this->result($characters);
    }

    public function deleteEpisodeCharacter($params, $episodeId)
    {
        $model = $this->repo->get($episodeId);
        if (is_null($model)) {
            return $this->errNotFound('Эпизод не найден');
        }

        $check = $this->repo->characterExistsInEpisode($params, $episodeId);
        if (is_null($check)) {
            return $this->errNotFound('Персонаж не существет в эпизоде');
        }

        $this->repo->deleteEpisodeCharacter($params, $episodeId);
        return $this->ok('Персонаж был отсоединен из эпизода');
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

    public function setImage($params)
    {
        $path = $params['image']->store('images');
        if (Storage::missing($path)) {
            return $this->errService('Ошибка сохранения картинки');
        }

        $result = $this->repo->setImage($params['id'], $path);
        return $this->result($result);
    }

    public function deleteImage($params)
    {
        $check = $this->repo->getImage($params['id']);
        if (is_null($check)) {
            return $this->errNotFound('У эпизода нет картинки');
        }

        $this->repo->deleteImage($params['id']);

        return $this->ok('Картинка удалена');
    }
}
