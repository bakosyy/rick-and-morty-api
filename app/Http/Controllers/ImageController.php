<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageStoreRequest;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    protected $service;
    public function __construct()
    {
        $this->service = new ImageService();
    }
    public function store(ImageStoreRequest $request)
    {
        $result = $this->service->store($request->validated());

        return $this->resultResource(ImageResource::class, $result);
    }

    public function destroy($id)
    {
        $result = $this->service->destroy($id);
        return $this->result($result);
    }
}
