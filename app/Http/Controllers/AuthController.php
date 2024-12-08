<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Interfaces\AuthRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends ApiController
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $token = $this->authRepository->register($validated);

        return response()->json(['token' => $token], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $token = $this->authRepository->login($credentials);

        return response()->json(['token' => $token], 200);
    }

    public function logout()
    {
        return $this->authRepository->logout();
    }

    public function profile()
    {
        return response()->json($this->authRepository->userProfile());
    }
}
