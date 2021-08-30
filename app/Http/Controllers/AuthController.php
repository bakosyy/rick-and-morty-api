<?php

namespace App\Http\Controllers;

use App\Services\v1\AuthService;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserLoginResource;
use App\Http\Resources\UserCabinetResource;

class AuthController extends Controller
{
    protected $service;

    public function __construct(AuthService $authService)
    {
        $this->service = $authService;
    }

    public function register(RegisterRequest $request)
    {
        $result = $this->service->register($request->validated());
        return $this->result($result);
    }

    public function login(LoginRequest $request)
    {
        $result = $this->service->login($request->validated());
        return $this->resultResource(UserLoginResource::class, $result);
    }

    public function cabinet()
    {
        $result = $this->service->cabinet();
        return $this->resultResource(UserCabinetResource::class, $result);
    }

    public function logout()
    {
        $result = $this->service->logout();
        return $this->result($result);
    }

    public function cabinetCatalog()
    {
        $result = $this->service->cabinetCatalog();
        return $this->result($result);
    }
}
