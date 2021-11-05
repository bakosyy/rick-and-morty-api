<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Illuminate\Http\Request;
use App\Services\v1\EpisodeCharacterService;
use App\Http\Requests\EpisodeCharacterIndexRequest;
use App\Http\Requests\EpisodeCharacterStoreRequest;
use App\Http\Requests\EpisodeCharacterDeleteRequest;
use App\Http\Resources\CharacterCollection;

class EpisodeCharacterController extends Controller
{
    protected $service;

    public function __construct(EpisodeCharacterService $service)
    {
        $this->service = $service;
    }

    public function index(EpisodeCharacterIndexRequest $request)
    {
        $episode_id = request()->route('episode');

        $collection = $this->service->index($episode_id, $request->validated());
        return $this->resultCollection(CharacterCollection::class, $collection);
    }


    public function store(EpisodeCharacterStoreRequest $request)
    {
        /**
         * Adding a character to the episode
         */
        $episode_id = request()->route('episode');
        $character_id = request('character_id');

        $result = $this->service->store($episode_id, $character_id);
        return $this->result($result);
    }

    public function destroy()
    {
        $episode_id = request()->route('episode');
        $character_id = request()->route('character');

        $result = $this->service->destroy($episode_id, $character_id);
        return $this->result($result);
    }
}
