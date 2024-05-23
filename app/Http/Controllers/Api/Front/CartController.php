<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Front\AddToCartRequest;
use App\Http\Resources\CartResource;
use App\Services\Api\Front\CartService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class CartController extends Controller
{
    use ApiResponseTrait;

    public function index(CartService $cartService)
    {
        return $this->apiResponse(CartResource::collection($cartService->index()),'Cart retrived successfully');
    }

    public function addToCart(AddToCartRequest $request, CartService $cartService)
    {
        return $this->apiResponse(CartResource::make($cartService->addToCart($request->validated())), 'Product added to Cart successfully');
    }

    public function removeItem($product_id, CartService $cartService)
    {
        return $this->apiResponse(CartResource::make($cartService->remove($product_id)), 'Product removed from Cart successfully');
    }

    public function destroy(CartService $cartService)
    {
        return $this->apiResponse($cartService->destroy(), 'Cart removed successfully');
    }
}
