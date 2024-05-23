<?php

namespace App\Services\Api;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileService
{
    public function index()
    {
        return auth()->user();
    }

    public function update($data)
    {
        $user = User::findOrFail(auth()->user()->id);
        $user->update($data);
        return $user;
    }

    public function updatePassword($data)
    {
        $user = User::findOrFail(auth()->user()->id);
        $user->update([
            'password' => Hash::make($data['password']),
        ]);
        return $user;
    }
}
