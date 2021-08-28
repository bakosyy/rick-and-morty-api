<?php

namespace App\Repositories;

use App\Models\Character;
use Illuminate\Support\Arr;
use App\Http\Requests\CharacterRequest;

class CharacterRepository
{
    protected $model;

    public function indexPaginate($params)
    {
        $per_page = $params['per_page'] ?? 10;
        $characters = $this->prepareQuery($params)->paginate($per_page);
        return $characters;
    }

    public function index($params)
    {
        return $this->prepareQuery($params)->get();
    }

    public function indexCharacterEpisodes($character_id, $params)
    {
        $per_page = $params['per_page'] ?? 10;
        $collection = $this->prepareCharacterEpisodesQuery($character_id, $params)->paginate($per_page);
        return $collection;
    }
    
    public function prepareQuery($params)
    {
        $query = Character::with(['image', 'birthLocation', 'currentLocation']);
        $query = $this->queryApplyFilter($query, $params);
        $query = $this->queryApplyOrder($query, $params);
        return $query;
    }

    public function prepareCharacterEpisodesQuery($character_id, $params)
    {
        $query = Character::find($character_id)->episodes();
        $query = $this->queryApplyFilter($query, $params);
        $query = $this->queryApplyOrder($query, $params);
        return $query;
    }
    
    public function queryApplyFilter($query, $params)
    {
        // Поиск по тексту
        if (isset($params['q'])) {
            $query->where(function ($subQuery) use ($params) {
                $subQuery->where('name', 'LIKE', '%' . $params['q'] . '%')
                    ->orWhere('description', 'LIKE', '%' . $params['q'] . '%');
            });
        }
        // По полу
        if (isset($params['gender'])) {
            is_array($params['gender'])
                ? $query->whereIn('gender', $params['gender'])
                : $query->where('gender', $params['gender']);
        }
        // По статусу
        if (isset($params['status'])) {
            is_array($params['status'])
                ? $query->whereIn('status', $params['status'])
                : $query->where('status', $params['status']);
        }
        // По расе
        if (isset($params['race'])) {
            is_array($params['race'])
                ? $query->whereIn('race', $params['race'])
                : $query->where('race', $params['race']);
        }
        return $query;
    }

    public function queryApplyOrder($query, $params)
    {
        $params['sort_way'] = $params['sort_way'] ?? 'asc';
        if (isset($params['sort'])) {
            $query->orderBy($params['sort'], $params['sort_way']);
        }
        return $query;
    }

    public function get($id)
    {
        return Character::find($id);
    }

    public function existsName($name, $id)
    {
        $character = Character::where('name', $name)->get()->first();
        if (!is_null($character) and $character->id != $id) {
            return true;
        } else {
            return false;
        }
    }

    public function store($params)
    {
        return Character::create($params);
    }

    public function update($params, $id)
    {
        $character = Character::find($id);
        $character->fill($params);
        $character->save();

        return $character;
    }

    public function destroy($id)
    {
        $character = Character::find($id);
        return $character->delete();
    }
}
