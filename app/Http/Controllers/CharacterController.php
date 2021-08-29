<?php

namespace App\Http\Controllers;

use App\Http\Resources\ImageResource;
use App\Services\v1\CharacterService;
use App\Http\Resources\CharacterResource;
use App\Http\Resources\CharacterCollection;
use App\Http\Requests\CharacterIndexRequest;
use App\Http\Requests\CharacterStoreRequest;
use App\Http\Requests\CharacterUpdateRequest;
use App\Http\Requests\CharacterSetImageRequest;
use App\Http\Requests\CharacterDeleteImageRequest;

class CharacterController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new CharacterService();
    }

    // Надо в параметр функции принимать класс валидации через создания класса $request
    public function index(CharacterIndexRequest $request)
    {
        $characters = $this->service->indexPaginate($request->validated());
        
        return $this->resultCollection(CharacterCollection::class, $characters);
    }

    public function indexCharacterEpisodes(CharacterIndexRequest $request)
    {
        $character_id = request()->route('character');

        $collection = $this->service->indexCharacterEpisodes($character_id, $request->validated());
        return $this->resultCollection(CharacterCollection::class, $collection);
    }

    public function show($id)
    {
        $result = $this->service->get($id);

        return $this->resultResource(CharacterResource::class, $result);
    }

    public function store(CharacterStoreRequest $request)
    {
        $character = $this->service->store($request->validated());
        return $this->result($character);
    }

    public function update(CharacterUpdateRequest $request, $id)
    {
        $character = $this->service->update($request->validated(), $id);

        return $this->result($character);
    }

    public function destroy($id)
    {
        $result = $this->service->destroy($id);

        return $this->result($result);
    }

    public function setImage(CharacterSetImageRequest $request)
    {
        $result = $this->service->setImage($request->validated());
        return $this->resultResource(ImageResource::class, $result);
    }

    public function deleteImage(CharacterDeleteImageRequest $request)
    {
        $result = $this->service->deleteImage($request->validated());
        return $this->result($result);
    }
}