<?php

namespace App\Http\Controllers;

use App\Http\Requests\CharacterRequest;
use App\Models\Character;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function index()
    {
        return Character::all();
    }

    public function store(CharacterRequest $request)
    {
        Character::add($request->validated());

        return [
            "message" => "Персонаж сохранен"
        ];
    }

    public function show(Character $character)
    {
        return $character;
    }

    public function update(CharacterRequest $request, Character $character)
    {
        $character->edit($request->validated());

        return [
            "message" => "Персонаж обновлен"
        ];
    }

    public function destroy(Character $character)
    {
        $character->delete();

        return [
            "message" => "Персонаж удален"
        ];
    }
}
