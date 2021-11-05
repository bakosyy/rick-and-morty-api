<?php

namespace App\Services\v1;

use App\Repositories\EpisodeCharacterRepository;
use App\Repositories\EpisodeRepository;

class EpisodeCharacterService extends BaseService
{
    protected $episodeCharacterRepo;
    protected $episodeRepo;

    public function __construct(EpisodeCharacterRepository $episodeCharacterRepo, EpisodeRepository $episodeRepo)
    {
        $this->episodeCharacterRepo = $episodeCharacterRepo;
        $this->episodeRepo = $episodeRepo;
    }

    public function index($episode_id, $params)
    {
        /**
         * Does episode exist?
         */
        $episode = $this->episodeRepo->get($episode_id);
        if (is_null($episode)) {
            return $this->errNotFound('Episode not found');
        }

        $collection = $this->episodeCharacterRepo->indexPaginate($episode_id, $params);
        return $this->result($collection);
    }

    public function store($episode_id, $character_id)
    {
        /**
         * Does episode exist?
         */
        $episode = $this->episodeRepo->get($episode_id);
        if (is_null($episode)) {
            return $this->errNotFound('Episode not found');
        }

        /**
         * Episode already has this character?
         */
        $check = $this->episodeCharacterRepo->episodeHasCharacter($episode_id, $character_id);
        if (!is_null($check)) {
            return $this->errValidate('Episode already has this character');
        }

        $this->episodeCharacterRepo->store($episode_id, $character_id);
        return $this->ok('Character added to episode');
    }

    public function destroy($episode_id, $character_id)
    {
        /*
         * Does episode exist?
         * */
        $episode = $this->episodeRepo->get($episode_id);
        if (is_null($episode)) {
            return $this->errNotFound('Episode not found');
        }

        /*
         * Does character exist in episode?
         * */
        $check = $this->episodeCharacterRepo->episodeHasCharacter($episode_id, $character_id);
        if (is_null($check)) {
            return $this->errNotFound('Episode doesn\'t have this character');
        }

        $this->episodeCharacterRepo->destroy($episode_id, $character_id);
        return $this->ok('Character was unlinked from episode');
    }

}