<?php

namespace App\Http\Controllers;

use App\Http\Requests\EpisodeCharacterRequest;
use App\Models\Episode;
use Illuminate\Http\Request;
use App\Services\v1\EpisodeService;
use App\Http\Resources\EpisodeResource;
use App\Http\Resources\EpisodeCollection;
use App\Http\Requests\EpisodeIndexRequest;
use App\Http\Requests\EpisodeStoreRequest;
use App\Http\Requests\EpisodeUpdateRequest;
use App\Http\Resources\CharacterCollection;
use App\Http\Resources\EpisodeCharactersResource;
use App\Http\Resources\EpisodeStoreResource;

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

    public function addCharacter(EpisodeCharacterRequest $request, $episode)
    {
        $result = $this->service->addCharacter($request->validated(), $episode);
        return $this->result($result);
    }
    
    public function getCharacters($episode)
    {
        $characters = $this->service->getCharacters($episode);
        return $this->resultCollection(CharacterCollection::class, $characters);
    }
    
    public function show($id)
    {
        $result = $this->service->get($id);
        return $this->resultResource(EpisodeResource::class, $result);
    }

    public function update(EpisodeUpdateRequest $request, $id)
    {
        $result = $this->service->update($request, $id);
        return $this->result($result);
    }

    public function destroy($id)
    {
        $result = $this->service->destroy($id);
        return $this->result($result);
    }
}
