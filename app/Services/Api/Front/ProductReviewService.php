<?php

namespace App\Services\Api\Front;

use App\Models\ProductReview;

class ProductReviewService
{
    public function store($data)
    {
        return ProductReview::create($data);
    }
}
