<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\Front\CategoryResource;
use App\Services\Api\Front\CategoryService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponseTrait;

    public function index(CategoryService $categoryService)
    {
        return $this->apiResponse(CategoryResource::collection($categoryService->index()), 'Categories retrived successfully');
    }
}
