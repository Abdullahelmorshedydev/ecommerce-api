<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Profie\UpdatePasswordRequest;
use App\Http\Requests\Api\Profie\UpdateProfileRequest;
use App\Http\Resources\AuthResourse;
use App\Services\Api\ProfileService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use ApiResponseTrait;

    public function index(ProfileService $profileService)
    {
        return $this->apiResponse(AuthResourse::make($profileService->index()), 'Profile Data Retrived Successfully');
    }

    public function update(UpdateProfileRequest $request, ProfileService $profileService)
    {
        return $this->apiResponse(AuthResourse::make($profileService->update($request->validated())), 'Profile Updated Successfully');
    }

    public function updatePassword(UpdatePasswordRequest $request, ProfileService $profileService)
    {
        return $this->apiResponse(AuthResourse::make($profileService->updatePassword($request->validated())), 'Profile Updated Successfully');
    }
}
