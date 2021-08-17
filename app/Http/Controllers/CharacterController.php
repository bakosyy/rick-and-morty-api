<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;
use App\Services\CharacterService;
use App\Http\Requests\CharacterRequest;
use App\Http\Resources\CharacterResource;
use App\Repositories\CharacterRepository;
use App\Http\Resources\CharacterCollection;

class CharacterController extends Controller
{
    protected $characterService;

    public function __construct(CharacterService $service)
    {
        $this->characterService = $service;
    }

    public function index()
    {
        $characters = $this->characterService->index();

        return new CharacterCollection($characters);       
    }

    public function show($id)
    {
        $character = $this->characterService->get($id);

        return new CharacterResource($character);
    }

    public function store(CharacterRequest $request)
    {
        $character = $this->characterService->store($request->validated());

        return [
            "message" => "Персонаж сохранен"
        ];
    }

    public function update(CharacterRequest $request, $id)
    {
        $character = $this->characterService->update($request->validated(), $id);

        return [
            "message" => "Персонаж обновлен"
        ];
    }

    public function destroy($id)
    {
        $this->characterService->destroy($id);

        return [
            "message" => "Персонаж удален"
        ];
    }
}
