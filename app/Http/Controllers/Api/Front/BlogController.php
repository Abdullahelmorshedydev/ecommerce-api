<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Front\BlogCommentRequest;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Services\Api\Front\BlogService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use ApiResponseTrait;

    public function index(BlogService $blogService)
    {
        return $this->apiResponse(BlogResource::collection($blogService->index()), 'Blogs retrived successfully');
    }

    public function show(Blog $blog)
    {
        return $this->apiResponse(BlogResource::make($blog), 'Blog retrived successfully');
    }

    public function comment(BlogCommentRequest $request, BlogService $blogService)
    {
        return $this->apiResponse(BlogResource::make($blogService->comment($request->validated())), 'Comment sent successfully');
    }
}
