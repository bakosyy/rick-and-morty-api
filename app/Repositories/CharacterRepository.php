<?php

namespace App\Repositories;

use App\Models\Character;
use Illuminate\Support\Arr;
use App\Http\Requests\CharacterRequest;

class CharacterRepository
{
    protected $model;

    public function index()
    {
        return Character
            ::select('id', 'name', 'status', 'gender', 'race', 'description')
            ->when(request('name'), function ($query, $value) {
                $query->where('name', $value);
            })
            ->when(request('gender'), function ($query, $value) {
                $query->whereIn('gender', $value);
            })
            ->when(request('status'), function ($query, $value) {
                $query->whereIn('status', $value);
            })
            ->when(request('race'), function ($query, $value) {
                $query->whereIn('race', $value);
            })
            ->paginate(3);
    }

    public function get($id)
    {
        return Character::findorFail($id);
    }

    public function store($request)
    {
        $character = new Character;
        $character->fill($request);
        $character->save();

        return $character;
    }

    public function update($request, $id)
    {
        $character = Character::findOrFail($id);
        $character->fill($request);
        $character->save();

        return $character;
    }

    public function destroy($id)
    {
        $character = Character::findOrFail($id);
        $character->delete();
    }
}
