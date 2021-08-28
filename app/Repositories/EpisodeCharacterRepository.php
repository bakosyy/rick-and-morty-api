<?php

namespace App\Repositories;

use App\Models\Episode;
use Illuminate\Database\Eloquent\Model;

class EpisodeCharacterRepository
{
    public function indexPaginate($episode_id, $params)
    {
        $per_page = $params['per_page'] ?? 10;
        return $this->prepareQuery($episode_id, $params)->paginate($per_page);
    }

    public function prepareQuery($episode_id, $params)
    {
        $query = Episode::find($episode_id)->characters();
        $query = $this->queryApplyFilters($query, $params);
        $query = $this->queryApplyOrder($query, $params);
        return $query;
    }

    public function queryApplyFilters($query, $params)
    {

        if (isset($params['q'])) {
            $query->where(function ($subQuery) use ($params) {
                $subQuery->where('name', 'like', '%' . $params['q'] . '%')
                    ->orWhere('description', 'like', '%' . $params['q'] . '%');
            });
        }
        if (isset($params['status'])) {
            if (is_array($params['status'])) {
                $query->whereIn('status', $params['status']);
            }
        }
        if (isset($params['gender'])) {
            if (is_array($params['gender'])) {
                $query->whereIn('gender', $params['gender']);
            }
        }
        if (isset($params['race'])) {
            if (is_array($params['race'])) {
                $query->whereIn('race', $params['race']);
            }
        }
        return $query;
    }

    public function queryApplyOrder($query, $params)
    {
        if (isset($params['sort'])) {
            if (isset($params['sort_way'])) {
                $query->orderBy($params['sort'], $params['sort_way']);
            }
            $query->orderBy($params['sort'], 'ASC');
        }
        return $query;
    }

    public function store($episode_id, $character_id)
    {
        return Episode::find($episode_id)->characters()->attach($character_id);
    }

    public function episodeHasCharacter($episode_id, $character_id)
    {
        return Episode::find($episode_id)->characters->firstWhere('id', $character_id);
    }

    public function destroy($episode_id, $character_id)
    {
        return Episode::find($episode_id)->characters()->detach($character_id);
    }
}
