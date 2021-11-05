<?php

namespace App\Services\v1;

use App\Repositories\AuthRepository;
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
        $user = $this->repo->register($params);
        if (is_null($user)) {
            return $this->errService('Something went wrong');
        }
        return $this->ok('User created');
    }

    public function login($params)
    {
        $user = $this->repo->getUserByPhone($params['phone']);
        if (is_null($user)) {
            return $this->errValidate('Incorrect data');
        }
        if (!Hash::check($params['password'], $user->password)) {
            return $this->errValidate('Incorrect password');
        }
        $token = $user->createToken($params['device_name'])->plainTextToken;
        $user['api_token'] = $token;
        return $this->result($user);
    }

    public function cabinet()
    {
        $user = $this->repo->getCurrentUser();
        if (is_null($user)) {
            return $this->errService('Something went wrong');
        }
        return $this->result($user);
    }

    public function logout()
    {
        $user = $this->repo->getCurrentUser();
        $user->currentAccessToken()->delete();
        return $this->ok('User logged out');
    }
}
