<?php

namespace App\Http\Controllers\Api\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Back\Blog\BlogStoreRequest;
use App\Http\Requests\Api\Back\Blog\BlogUpdateRequest;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Services\Api\Back\BlogService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(BlogService $blogService)
    {
        return $this->apiResponse(BlogResource::collection($blogService->index()), 'Blogs retrived successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogStoreRequest $request, BlogService $blogService)
    {
        return $this->apiResponse(BlogResource::make($blogService->store($request->validated())), 'Blog created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return $this->apiResponse(BlogResource::make($blog), 'Blog Retrived successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogUpdateRequest $request, Blog $blog, BlogService $blogService)
    {
        return $this->apiResponse(BlogResource::make($blogService->update($blog, $request->validated())), 'Blog updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog, BlogService $blogService)
    {
        return $this->apiResponse($blogService->destroy($blog), 'Blog deleted successfully');
    }
}
