<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationIndexRequest;
use App\Http\Requests\LocationStoreRequest;
use App\Http\Requests\LocationUpdateRequest;
use App\Http\Resources\LocationCollection;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Services\v1\LocationService;

class LocationController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new LocationService();
    }
    
    public function index(LocationIndexRequest $request)
    {
        $result = $this->service->index($request->validated());

        return $this->resultCollection(LocationCollection::class, $result);
    }

    public function store(LocationStoreRequest $request)
    {
        $result = $this->service->store($request->validated());

        return $this->result($result);
    }

    public function show($id)
    {
        $result = $this->service->get($id);
        
        return $this->resultResource(LocationResource::class, $result);
    }

    public function update(LocationUpdateRequest $request, $id)
    {
        $result = $this->service->update($request->validated(), $id);

        return $this->result($result);
    }

    public function destroy($id)
    {
        $result = $this->service->destroy($id);

        return $this->result($result);
    }
}
