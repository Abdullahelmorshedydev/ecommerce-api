<?php

namespace App\Services\Api\Front;

use App\Models\ProductReview;

class ProductReviewService
{
    public function index()
    {
        return ProductReview::paginate();
    }

    public function store($data)
    {
        return ProductReview::create($data);
    }

    public function update($productReview, $data)
    {
        $productReview->update($data);
        return $productReview;
    }
}
