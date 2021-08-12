<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function index()
    {
        return Character::all();
    }

    public function store(Request $request)
    {
        Character::add($request->all());

        return [
            "message" => "Персонаж сохранен"
        ];
    }

    public function show(Character $character)
    {
        return $character;
    }

    public function update(Request $request, Character $character)
    {
        $character->edit($request->all());

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
