<?php

namespace App\Services\Api\Back;

use App\Models\Blog;
use App\Traits\FilesTrait;

class BlogService
{
    use FilesTrait;

    public function index()
    {
        return Blog::paginate();
    }

    public function store($data)
    {
        $data['user_id'] = auth()->user()->id;
        $blog = Blog::create($data);
        if (isset($data['image'])) {
            $blog->image()->create([
                'image' => FilesTrait::store($data['image'], Blog::IMG_URL),
            ]);
        }
        return $blog;
    }

    public function update($blog, $data)
    {
        $data['user_id'] = auth()->user()->id;
        $blog->update($data);
        if (isset($data['image'])) {
            $blog->image()->update([
                'image' => FilesTrait::store($data['image'], Blog::IMG_URL),
            ]);
        }
        return $blog;
    }

    public function destroy($blog)
    {
        $blog->image()->delete();
        $blog->delete();
        return true;
    }
}
