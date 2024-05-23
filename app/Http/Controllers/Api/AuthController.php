<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Resources\AuthResourse;
use App\Services\Api\AuthService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponseTrait;

    public function login(LoginRequest $request, AuthService $authService)
    {
        return $this->apiResponse(AuthResourse::make($authService->login($request->validated())), 'login Successfuly');
    }

    public function register(RegisterRequest $request, AuthService $authService)
    {
        return $this->apiResponse(AuthResourse::make($authService->register($request->validated())), 'Register Successfully');
    }

    public function logout(AuthService $authService)
    {
        return $this->apiResponse($authService->logout(), 'Logout Successfully');
    }
}
