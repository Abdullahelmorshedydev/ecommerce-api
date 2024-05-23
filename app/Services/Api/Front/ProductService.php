<?php

namespace App\Services\Api\Front;

use App\Models\Product;

class ProductService
{
    public function index()
    {
        return Product::paginate();
    }
}
