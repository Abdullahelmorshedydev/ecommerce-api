<?php

namespace App\Services\Api;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function login($data)
    {
        $user = User::where('email', $data['email'])->first();
        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials'],
            ]);
        }
        $user['token'] = $user->createToken('Api Token Of ' . $user->name)->plainTextToken;
        return $user;
    }

    public function register($data)
    {
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $user['token'] = $user->createToken('Api Token Of ' . $user->name)->plainTextToken;
        return $user;
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return true;
    }
}
