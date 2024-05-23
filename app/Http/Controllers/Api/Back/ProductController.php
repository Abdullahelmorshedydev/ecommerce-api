<?php

namespace App\Http\Controllers\Api\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Back\Product\ProductStoreRequest;
use App\Http\Requests\Api\Back\Product\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\Api\Back\ProductService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(ProductService $productService)
    {
        return $this->apiResponse(ProductResource::collection($productService->index()), 'Products retrived successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request, ProductService $productService)
    {
        return $this->apiResponse(ProductResource::make($productService->store($request->validated())), 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return $this->apiResponse(ProductResource::make($product), 'Product Retrived successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product, ProductService $productService)
    {
        return $this->apiResponse(ProductResource::make($productService->update($product, $request->validated())), 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, ProductService $productService)
    {
        return $this->apiResponse($productService->destroy($product), 'Product deleted successfully');
    }
}
