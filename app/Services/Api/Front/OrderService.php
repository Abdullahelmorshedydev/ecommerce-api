<?php

namespace App\Services\Api\Front;

use App\Enums\OrderStatusEnum;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;

class OrderService
{
    public function index()
    {
        return Order::where('user_id', auth()->user()->id)->paginate();
    }

    public function store($data)
    {
        $coupon = Coupon::where('code', $data['coupon'])->first();
        $data['discount'] = $coupon ? $data['total'] - $coupon->type->calc($data['total'], $coupon->value) : 0;
        $data['user_id'] = auth()->user()->id;
        $data['total'] = auth()->user()->cart->total;

        $order = Order::create($data);

        if ($coupon) {
            $coupon->update([
                'number_of_usage' => $coupon->number_of_usage + 1,
            ]);
        }

        foreach (auth()->user()->cart->cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_color_id' => $cartItem->product_color_id,
                'quantity' => $cartItem->quantity,
                'product_total' => $cartItem->product->discount ? (int)$cartItem->product->discount_type->calc($cartItem->product->price, $cartItem->product->discount) : (int)$cartItem->product->price,
            ]);
            $cartItem->product->update([
                'sales_count' => $cartItem->product->sales_count + 1,
            ]);
        }
        auth()->user()->cart->delete();
        auth()->user()->load('orders');
        return auth()->user()->orders()->where('id', $order->id)->first();
    }

    public function applyCoupon($data)
    {
        return ['coupon_id' => Coupon::where('code', $data['coupon_code'])->first()->id];
    }

    public function cancelOrder($order_id)
    {
        auth()->user()->orders()->where('id', $order_id)->update([
            'status' => OrderStatusEnum::CANCELED->value,
        ]);
        auth()->user()->load('orders');
        return auth()->user()->orders;
    }
}
