<?php

namespace App\Services\Api\Front;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class CartService
{
    public function index()
    {
        return Cart::where('user_id', auth()->user()->id)->get();
    }

    public function addToCart($data)
    {
        $data['user_id'] = auth()->user()->id;
        $product = Product::where('id', $data['id'])->first();
        $productPrice = 0;

        if($product->discount) {
            $productPrice = $product->discount_type->calc($product->price, $product->discount);
        } else {
            $productPrice = $product->price;
        }

        $cart = auth()->user()->cart;

        if (!isset($cart)) {
            $cart = Cart::create($data);
        }

        $cart_item = CartItem::where('cart_id', $cart->id)->where('product_id', $data['id'])->first();
        if (!isset($cart_item)) {
            $cart_item = CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $data['id'],
                'product_color_id' => $data['color_id'],
                'quantity' => $data['quantity'],
            ]);
            $cart->update([
                'total' => $cart->total + ($productPrice * $data['quantity']),
            ]);
        } else {
            $cart->update([
                'total' => $cart->total - ($productPrice * $cart_item->quantity),
            ]);
            $cart_item->update([
                'quantity' => $data['quantity'],
                'product_color_id' => $data['color_id'],
            ]);
            $cart->update([
                'total' => $cart->total + ($productPrice * $data['quantity']),
            ]);
        }
        auth()->user()->load('cart');
        return auth()->user()->cart;
    }

    public function remove($product_id)
    {
        $cart = auth()->user()->cart;
        $cart_item = CartItem::where(['cart_id' => $cart->id, 'product_id' => $product_id])->first();
        $cart->update([
            'total' => $cart->total - ($cart_item->product->discount ? $cart_item->product->discount_type->calc($cart_item->product->price, $cart_item->product->discount) : $cart_item->product->price * $cart_item->quantity),
        ]);
        $cart_item->delete();
        return auth()->user()->cart;
    }

    public function destroy()
    {
        auth()->user()->cart->delete();
        return true;
    }
}
