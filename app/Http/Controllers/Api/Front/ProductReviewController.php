<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Front\ProductReview\ProductReviewStoreRequest;
use App\Http\Requests\Api\Front\ProductReview\ProductReviewUpdateRequest;
use App\Http\Resources\ProductReviewResource;
use App\Models\ProductReview;
use App\Services\Api\Front\ProductReviewService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    use ApiResponseTrait;

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductReviewStoreRequest $request, ProductReviewService $productReviewService)
    {
        return $this->apiResponse(ProductReviewResource::make($productReviewService->store($request->validated())), 'Product Review created successfully');
    }
}
