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
     * Display a listing of the resource.
     */
    public function index(ProductReviewService $productReviewService)
    {
        return $this->apiResponse(ProductReviewResource::collection($productReviewService->index()), 'Product Reviews retrived successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductReviewStoreRequest $request, ProductReviewService $productReviewService)
    {
        return $this->apiResponse(ProductReviewResource::make($productReviewService->store($request->validated())), 'Product Review created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductReview $productReview)
    {
        return $this->apiResponse(ProductReviewResource::make($productReview), 'Product Review Retrived successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductReviewUpdateRequest $request, ProductReview $productReview, ProductReviewService $productReviewService)
    {
        return $this->apiResponse(ProductReviewResource::make($productReviewService->update($productReview, $request->validated())), 'Product Review updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductReview $productReview)
    {
        return $this->apiResponse([$productReview->delete()], 'Product Review deleted successfully');
    }
}
