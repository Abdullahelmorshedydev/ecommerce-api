<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\WishlistResource;
use App\Services\Api\Front\WishlistService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    use ApiResponseTrait;

    public function index(WishlistService $wishlistService)
    {
        return $this->apiResponse(WishlistResource::collection($wishlistService->index()),'Wishlist retrived successfully');
    }

    public function store($product_id, WishlistService $wishlistService)
    {
        return $this->apiResponse(WishlistResource::make($wishlistService->store($product_id)), 'Product added to wishlist successfully');
    }

    public function remove($product_id, WishlistService $wishlistService)
    {
        return $this->apiResponse(WishlistResource::make($wishlistService->remove($product_id)), 'Product removed from wishlist successfully');
    }

    public function destroy(WishlistService $wishlistService)
    {
        return $this->apiResponse($wishlistService->destroy(), 'Wishlist removed successfully');
    }
}
