<?php

namespace App\Services\Api\Front;

use App\Models\Wishlist;

class WishlistService
{
    public function index()
    {
        return Wishlist::where('user_id', auth()->user()->id)->get();
    }

    public function store($product_id)
    {
        return Wishlist::create([
            'product_id' => $product_id,
            'user_id' => auth()->user()->id,
        ]);
    }

    public function remove($product_id)
    {
        return auth()->user()->wishlists()->where('product_id', $product_id)->first()->delete();
    }

    public function destroy()
    {
        auth()->user()->wishlists()->delete();
        return true;
    }
}
