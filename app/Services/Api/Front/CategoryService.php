<?php

namespace App\Services\Api\Front;

use App\Models\Category;

class CategoryService
{
    public function index()
    {
        return Category::paginate();
    }
}
