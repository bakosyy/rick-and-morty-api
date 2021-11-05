<?php

namespace App\Services\v1;

use App\Http\Requests\CharacterRequest;
use App\Repositories\CharacterRepository;
use Illuminate\Support\Facades\Storage;

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

    public function indexCharacterEpisodes($character_id, $params)
    {
        $model = $this->repo->get($character_id);
        if (is_null($model)) {
            return $this->errNotFound('Персонаж не найден');
        }

        $collection = $this->repo->indexCharacterEpisodes($character_id, $params);
        return $this->result($collection);
    }

    public function store($params)
    {
        $model = $this->repo->store($params);
        if (is_null($model)) {
            return $this->errService('Error creating a character');
        }
        return $this->ok('Character saved');
    }

    public function update($params, $id)
    {
        /**
         * Does the model exist?
         */
        $model = $this->repo->get($id);
        if (is_null($model)) {
            return $this->errNotFound('Character not found');
        }

        /**
         * Is there a character with this name?
         */
        if ($this->repo->existsName($params['name'], $id)) {
            return $this->errValidate('Character with this name already exists');
        }

        $this->repo->update($params, $id);
        return $this->ok('Character updated');
    }

    public function destroy($id)
    {
        // Checking if character exists
        $model = $this->repo->get($id);
        if (is_null($model)) {
            return $this->errNotFound('Character not found');
        }

        $this->repo->destroy($id);
        return $this->ok('Character deleted');
    }

    public function setImage($params)
    {
        $path = $params['image']->store('images');
        if (Storage::missing($path)) {
            return $this->errService('Error occurred while saving an image');
        }

        $model = $this->repo->setImage($params['id'], $path);
        return $this->result($model);
    }

    public function deleteImage($params)
    {
        // Check if a character has an image
        $check = $this->repo->getImage($params['id']);
        if (is_null($check)) {
            return $this->errNotFound('Nothing to delete');
        }

        $this->repo->deleteImage($params['id']);
        return $this->ok('Image deleted');
    }
}
