<?php

namespace App\Http\Controllers;

use App\Http\Request\Auth\LoginRequest;
use App\Http\Request\Auth\RegisterRequest;
use App\Models\Role;
use App\Models\User;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where('login', $request->login)->first();
        $user->tokens()->delete();
        $token = $user->createToken('authToken')->plainTextToken;
        return $this->createResponse(['token' => $token], 200, 'OK');
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
                'password' => $request->password,
                'photo_file' => $request->photo_file ? $request->photo_file->store('public') : null,
            ] + $request->all()
        );

        return $this->createResponse([
            'id' => $user->id,
            'status' => 'created'
        ], 201, 'Created');
    }
}
