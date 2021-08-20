<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CharacterService;
use App\Http\Requests\CharacterRequest;
use App\Http\Resources\CharacterResource;
use App\Http\Resources\CharacterCollection;
use App\Http\Requests\CharacterIndexRequest;

class CharacterController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new CharacterService();
    }

    // Надо в параметр функции принимать класс валидации через создания класса $request
    public function index(CharacterIndexRequest $request)
    {
        $characters = $this->service->indexPaginate($request->validated());

        return $this->resultCollection(CharacterCollection::class, $characters);
    }

    public function show($id)
    {
        $result = $this->service->get($id);

        return $this->resultResource(CharacterResource::class, $result);
    }

    public function store(CharacterRequest $request)
    {
        $character = $this->service->store($request->validated());
        return $this->result($character);
    }

    public function update(CharacterRequest $request, $id)
    {
        $character = $this->service->update($request->validated(), $id);

        return $this->result($character);
    }

    public function destroy($id)
    {
        $result = $this->service->destroy($id);

        return $this->result($result);
    }
}
