<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class AuthRepository
{
    public function register($params)
    {
        $user = new User;
        $user->fill($params);
        $user->password = Hash::make($params['phone']);
        $user->save();
        return $user;
    }

    public function getUserByPhone($phone)
    {
        return User::where('phone', $phone)->first();
    }

    public function getCurrentUser()
    {
        return Auth::user();
    }
}
