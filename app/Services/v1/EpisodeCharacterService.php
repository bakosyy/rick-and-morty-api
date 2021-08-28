<?php

namespace App\Services\v1;

use App\Repositories\EpisodeRepository;
use App\Repositories\EpisodeCharacterRepository;

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
         * Существует ли такой эпизод
         */
        $episode = $this->episodeRepo->get($episode_id);
        if (is_null($episode)) {
            return $this->errNotFound('Эпизод не найден');
        }
        
        $collection = $this->episodeCharacterRepo->indexPaginate($episode_id, $params);
        return $this->result($collection);
    }
    
    public function store($episode_id, $character_id)
    {
        /**
         * Существует ли такой эпизод?
         */
        $episode = $this->episodeRepo->get($episode_id);
        if (is_null($episode)) {
            return $this->errNotFound('Эпизод не найден');
        }

        /**
         * Эпизод уже имеет такого персонажа
         */
        $check = $this->episodeCharacterRepo->episodeHasCharacter($episode_id, $character_id);
        if (!is_null($check)) {
            return $this->errValidate('В эпизоде уже есть такой персонаж');
        }
        
        $this->episodeCharacterRepo->store($episode_id, $character_id);
        return $this->ok('Персонаж добавлен к эпизоду');
    }

    public function destroy($episode_id, $character_id)
    {
        /**
         * Существует ли такой эпизод?
         */
        $episode = $this->episodeRepo->get($episode_id);
        if (is_null($episode)) {
            return $this->errNotFound('Эпизод не найден');
        }

        $check = $this->episodeCharacterRepo->episodeHasCharacter($episode_id, $character_id);
        if (is_null($check)) {
            return $this->errNotFound('Нет такого персонажа в эпизоде');
        }

        $this->episodeCharacterRepo->destroy($episode_id, $character_id);
        return $this->ok('Персонаж был отсоединен из эпизода');
    }
    
}