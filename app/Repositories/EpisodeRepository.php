<?php

namespace App\Repositories;

use App\Models\Episode;
use App\Services\v1\Helper;

class EpisodeRepository
{
    public function indexPaginate($params)
    {
        $per_page = $params['per_page'] ?? 10;

        return $this->prepareQuery($params)->paginate($per_page);
    }

    public function prepareQuery($params)
    {
        $query = Episode::with(['image']);
        $query = $this->queryApplyFilters($query, $params);
        $query = $this->queryApplyOrders($query, $params);
        return $query;
    }

    public function queryApplyFilters($query, $params)
    {
        $q = $params['q'] ?? null;
        $season = $params['season'] ?? null;
        $series = $params['series'] ?? null;
        $premiere_from = $params['premiere_from'] ?? null;
        $premiere_to = $params['premiere_to'] ?? null;

        if (Helper::isNotEmptyString($q)) {
            $query->where(function ($subQuery) use ($q) {
                $subQuery->where('name', 'LIKE', '%' . $q . '%')
                    ->orWhere('description', 'LIKE', '%' . $q . '%');
            });
        }
        if (Helper::isNotEmptyArray($season)) {
            $query->whereIn('season', $season);
        }
        if (Helper::isNotEmptyArray($series)) {
            $query->whereIn('series', $series);
        }
        if (Helper::isNotEmptyString($premiere_from)) {
            $query->where('premiere', '>=', $premiere_from);
        }
        if (Helper::isNotEmptyString($premiere_to)) {
            $query->where('premiere', '<=', $premiere_to);
        }
        return $query;
    }

    public function queryApplyOrders($query, $params)
    {
        $sort = $params['sort'] ?? 'premiere';
        $sort_way = $params['sort_way'] ?? 'asc';

        $query->orderBy($sort, $sort_way);
        return $query;
    }

    public function store($params)
    {
        return Episode::create($params);
    }

    public function addEpisodeCharacter($params, $episodeId)
    {
        $episode = Episode::find($episodeId);
        return $episode->characters()->syncWithoutDetaching($params['character_id']);
    }

    public function getEpisodeCharacters($id)
    {
        return Episode::find($id)->characters()->with(['image', 'birth_location', 'current_location'])->paginate();
    }

    public function deleteEpisodeCharacter($params, $episodeId)
    {
        return Episode::find($episodeId)->characters()->detach($params['character_id']);
    }

    public function characterExistsInEpisode($characterId, $episodeId)
    {
        $characters = Episode::find($episodeId)->characters;
        if ($characters->isEmpty()) {
            return false;
        }

        $check = $characters->firstWhere('id', $characterId);
        if (!$check) {
            return false;
        }
        return true;
    }

    public function get($id)
    {
        return Episode::find($id);    
    }

    public function update($params, $id)
    {
        $model = Episode::find($id);
        $model->fill($params);
        $model->save();
        return $model;
    }

    public function destroy($id)
    {
        return Episode::destroy($id);
    }
}
