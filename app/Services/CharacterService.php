<?php

namespace App\Services;

use App\Http\Requests\CharacterRequest;
use App\Models\Character;
use App\Repositories\CharacterRepository;

class CharacterService
{
    protected $repository;

    public function __construct(CharacterRepository $characterRepository)
    {
        $this->repository = $characterRepository;
    }
    
    public function index()
    {
        return $this->repository->index();
    }
    
    public function get($id)
    {
        return $this->repository->get($id);
    }
    
    public function store($request)
    {
        return $this->repository->store($request);
    }
    
    public function update($request, $id)
    {
        return $this->repository->update($request, $id);
    }
    
    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}