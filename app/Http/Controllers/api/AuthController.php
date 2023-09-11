<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(User $user, RegisterRequest $request)
    {
        $created = $user->create($request->all());
        Auth::login($created);
        $token = $created->createToken('auth_token')->plainTextToken;

        return Controller::response(true, 'User created successfully', [
            'user' => $created,
            'token' => $token
        ], Response::HTTP_OK);
    }

    public function login(User $user, LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return Controller::response(false, 'Invalid credentials', null, Response::HTTP_UNAUTHORIZED);
        }

        $user = $user->where('email', $request->email)->first();
        $token = $user->createToken('auth_token')->plainTextToken;

        return Controller::response(true, 'User logged in successfully', [
            'user' => $user->only('name', 'email'),
            'token' => $token
        ], Response::HTTP_OK);
    }
}
