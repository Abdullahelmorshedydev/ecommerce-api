<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Front\Order\ApplyCouponRequest;
use App\Http\Requests\Api\Front\Order\SaveOrderRequest;
use App\Http\Resources\OrderResource;
use App\Services\Api\Front\OrderService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ApiResponseTrait;

    public function index(OrderService $orderService)
    {
        return $this->apiResponse(OrderResource::collection($orderService->index()), 'Orders retrived successfully');
    }

    public function saveOrder(SaveOrderRequest $request, OrderService $orderService)
    {
        return $this->apiResponse(OrderResource::make($orderService->store($request->validated())), 'Order saved successfully');
    }

    public function applyCoupon(ApplyCouponRequest $request, OrderService $orderService)
    {
        return $this->apiResponse($orderService->applyCoupon($request->validated()), 'Coupon applied successfully');
    }

    public function cancelOrder($order_id, OrderService $orderService)
    {
        return $this->apiResponse(OrderResource::collection($orderService->cancelOrder($order_id)), 'Order Canceled successfully');
    }
}
