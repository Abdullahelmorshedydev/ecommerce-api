<?php

namespace App\Services\Api\Front;

use App\Models\Blog;
use App\Models\BlogComment;

class BlogService
{
    public function index()
    {
        return Blog::paginate();
    }

    public function comment($data)
    {
        BlogComment::create($data);
        return Blog::where('id', $data['blog_id'])->first();
    }
}
