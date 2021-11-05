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
            return $this->errService('Error occured');
        }
        return $this->result($model);
    }

    public function addEpisodeCharacter($params, $episodeId)
    {
        $model = $this->repo->get($episodeId);
        if (is_null($model)) {
            return $this->errNotFound('Episode not found');
        }

        $check = $this->repo->characterExistsInEpisode($params['character_id'], $episodeId);
        if ($check == true) {
            return $this->errValidate('Character already exists in episode');
        }

        $this->repo->addEpisodeCharacter($params, $episodeId);
        return $this->ok('Character added to episode');
    }

    public function getEpisodeCharacters($id)
    {
        $model = $this->repo->get($id);
        if (is_null($id)) {
            return $this->errNotFound('Episode not found');
        }

        $characters = $this->repo->getEpisodeCharacters($id);
        return $this->result($characters);
    }

    public function deleteEpisodeCharacter($params, $episodeId)
    {
        $model = $this->repo->get($episodeId);
        if (is_null($model)) {
            return $this->errNotFound('Episode not found');
        }

        $check = $this->repo->characterExistsInEpisode($params, $episodeId);
        if (is_null($check)) {
            return $this->errNotFound('Character not found in episode');
        }

        $this->repo->deleteEpisodeCharacter($params, $episodeId);
        return $this->ok('Character was unlinked from episode');
    }

    public function get($id)
    {
        $model = $this->repo->get($id);
        if (is_null($model)) {
            return $this->errNotFound('Episode not found');
        }
        return $this->result($model);
    }

    public function update($params, $id)
    {
        $model = $this->repo->get($id);
        if (is_null($model)) {
            return $this->errNotFound('Episode not found');
        }

        $this->repo->update($params, $id);
        return $this->ok('Episode updated');
    }

    public function destroy($id)
    {
        $model = $this->repo->get($id);
        if (is_null($model)) {
            return $this->errNotFound('Episode not found');
        }

        $this->repo->destroy($id);
        return $this->ok('Episode deleted');
    }

    public function setImage($params)
    {
        $path = $params['image']->store('images');
        if (Storage::missing($path)) {
            return $this->errService('Error while setting an image');
        }

        $result = $this->repo->setImage($params['id'], $path);
        return $this->result($result);
    }

    public function deleteImage($params)
    {
        $check = $this->repo->getImage($params['id']);
        if (is_null($check)) {
            return $this->errNotFound('Episode has no image');
        }

        $this->repo->deleteImage($params['id']);

        return $this->ok('Image deleted');
    }
}
