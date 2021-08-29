<?php

namespace App\Http\Controllers;

use App\Services\v1\EpisodeService;
use App\Http\Resources\ImageResource;
use App\Http\Resources\EpisodeResource;
use App\Http\Resources\EpisodeCollection;
use App\Http\Requests\EpisodeIndexRequest;
use App\Http\Requests\EpisodeStoreRequest;
use App\Http\Requests\EpisodeUpdateRequest;
use App\Http\Resources\EpisodeStoreResource;
use App\Http\Requests\EpisodeSetImageRequest;
use App\Http\Requests\EpisodeDeleteImageRequest;

class EpisodeController extends Controller
{
    protected $service;
    public function __construct()
    {
        $this->service = new EpisodeService();
    }

    public function index(EpisodeIndexRequest $request)
    {
        $result = $this->service->index($request->validated());
        return $this->resultCollection(EpisodeCollection::class, $result);
    }
    public function store(EpisodeStoreRequest $request)
    {
        $result = $this->service->store($request->validated());
        return $this->resultResource(EpisodeStoreResource::class, $result);
    }

    public function show($id)
    {
        $result = $this->service->get($id);
        return $this->resultResource(EpisodeResource::class, $result);
    }

    public function update(EpisodeUpdateRequest $request, $id)
    {
        $result = $this->service->update($request->validated(), $id);
        return $this->result($result);
    }

    public function destroy($id)
    {
        $result = $this->service->destroy($id);
        return $this->result($result);
    }

    public function setImage(EpisodeSetImageRequest $request)
    {
        $result = $this->service->setImage($request->validated());
        return $this->resultResource(ImageResource::class, $result);
    }

    public function deleteImage(EpisodeDeleteImageRequest $request)
    {
        $result = $this->service->deleteImage($request->validated());
        return $this->result($result);
    }
}
