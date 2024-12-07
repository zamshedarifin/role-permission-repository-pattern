<?php

namespace App\Repositories;

use App\Interfaces\AuthRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthRepositoryInterface
{
    public function register(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return $user->createToken('API Token')->accessToken;
    }

    public function login(array $credentials)
    {
        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();
        return $user->createToken('API Token')->accessToken;
    }

    public function logout()
    {
        $user = Auth::user();
        $user->token()->revoke();

        return response()->json(['message' => 'Logged out successfully']);
    }

    public function userProfile()
    {
        return Auth::user();
    }
}
