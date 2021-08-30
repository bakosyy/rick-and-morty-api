<?php

namespace App\Services\v1;

use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService extends BaseService
{
    protected $repo;

    public function __construct(AuthRepository $authRepository)
    {
        $this->repo = $authRepository;
    }
    
    public function register($params)
    {
        $this->repo->register($params);
        return $this->ok('Пользователь зарегистрирован');
    }

    public function login($params)
    {
        $user = $this->repo->getUserByPhone($params['phone']);
        
        if (Hash::check($params['phone'], $user->phone)) {
            return $this->errValidate('Неправильные данные');
        }
        $token = $user->createToken($params['device_name'])->plainTextToken;
        $user['api_token'] = $token;
        return $this->result($user);
    }

    public function cabinet()
    {
        $user = $this->repo->getCurrentUser();
        if (is_null($user)) {
            return $this->errService('Какая-то ошибка');
        }
        return $this->result($user);
    }

    public function logout()
    {
        $user = $this->repo->getCurrentUser();
        $user->currentAccessToken()->delete();
        return $this->ok('Пользователь разлогинен');
    }
}