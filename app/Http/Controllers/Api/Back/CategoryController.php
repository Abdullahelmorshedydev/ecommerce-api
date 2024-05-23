<?php

namespace App\Http\Controllers\Api\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Back\Category\CategoryStoreRequest;
use App\Http\Requests\Api\Back\Category\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\Api\Back\CategoryService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(CategoryService $categoryService)
    {
        return $this->apiResponse(CategoryResource::collection($categoryService->index()), 'Categories retrived successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request, CategoryService $categoryService)
    {
        return $this->apiResponse(CategoryResource::make($categoryService->store($request->validated())), 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return $this->apiResponse(CategoryResource::make($category), 'Category Retrived successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, Category $category, CategoryService $categoryService)
    {
        return $this->apiResponse(CategoryResource::make($categoryService->update($category, $request->validated())), 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, CategoryService $categoryService)
    {
        return $this->apiResponse($categoryService->destroy($category), 'Category deleted successfully');
    }
}
