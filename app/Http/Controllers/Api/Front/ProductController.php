<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\Front\ProductResource;
use App\Services\Api\Front\ProductService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ApiResponseTrait;

    public function index(ProductService $productService)
    {
        return $this->apiResponse(ProductResource::collection($productService->index()), 'Products retrived successfully');
    }
}
