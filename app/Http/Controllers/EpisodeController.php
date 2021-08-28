<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Illuminate\Http\Request;
use App\Services\v1\EpisodeService;
use App\Http\Resources\EpisodeResource;
use App\Http\Resources\EpisodeCollection;
use App\Http\Requests\EpisodeIndexRequest;
use App\Http\Requests\EpisodeStoreRequest;
use App\Http\Requests\EpisodeUpdateRequest;
use App\Http\Resources\CharacterCollection;
use App\Http\Resources\EpisodeStoreResource;
use App\Http\Requests\EpisodeCharacterRequest;
use App\Http\Requests\EpisodeCharacterAddRequest;
use App\Http\Requests\EpisodeCharacterDeleteRequest;
use App\Http\Resources\EpisodeCharactersResource;

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

    public function addEpisodeCharacter(EpisodeCharacterAddRequest $request, $episodeId)
    {
        $result = $this->service->addEpisodeCharacter($request->validated(), $episodeId);
        return $this->result($result);
    }

    public function getEpisodeCharacters($episode)
    {
        $characters = $this->service->getEpisodeCharacters($episode);
        return $this->resultCollection(CharacterCollection::class, $characters);
    }

    public function deleteEpisodeCharacter(EpisodeCharacterDeleteRequest $request, $episodeId)
    {
        $result = $this->service->deleteEpisodeCharacter($request->validated(), $episodeId);
        return $this->result($result);
    }
}
