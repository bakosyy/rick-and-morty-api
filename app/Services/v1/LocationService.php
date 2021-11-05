<?php

namespace App\Services\v1;

use Illuminate\Support\Facades\Storage;
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
            return $this->errService('Error creating a location');
        }

        return $this->ok('Location created');
    }

    public function get($id)
    {
        $model = $this->repo->get($id);

        if (is_null($model)) {
            return $this->errNotFound('Location not found');
        }

        return $this->result($model);
    }

    public function update($params, $id)
    {
        /**
         * Does location exist?
         */
        $location = $this->repo->get($id);
        if (is_null($location)) {
            return $this->errNotFound('Location not found');
        }

        $this->repo->update($params, $id);
        return $this->ok('Location updated');
    }

    public function destroy($id)
    {
        /**
         * Does location exist?
         */
        $location = $this->repo->get($id);
        if (is_null($location)) {
            return $this->errNotFound('Location not found');
        }

        $this->repo->destroy($id);
        return $this->ok('Location deleted');
    }

    public function setImage($params)
    {
        $path = $params['image']->store('images');
        if (Storage::missing($path)) {
            return $this->errService('Error saving an image');
        }

        $model = $this->repo->setImage($params['id'], $path);
        return $this->result($model);
    }

    public function deleteImage($params)
    {
        $check = $this->repo->getImage($params['id']);
        if (is_null($check)) {
            return $this->errNotFound('Location has no image');
        }

        $this->repo->deleteImage($params['id']);
        return $this->ok('Image deleted');
    }
}
