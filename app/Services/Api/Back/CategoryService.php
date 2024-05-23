<?php

namespace App\Services\Api\Back;

use App\Models\Category;
use App\Traits\FilesTrait;

class CategoryService
{
    use FilesTrait;

    public function index()
    {
        return Category::paginate();
    }

    public function store($data)
    {
        $category = Category::create($data);
        if (isset($data['image'])) {
            $category->image()->create([
                'image' => FilesTrait::store($data['image'], Category::IMG_URL),
            ]);
        }
        return $category;
    }

    public function update($category, $data)
    {
        $category->update($data);
        if (isset($data['image'])) {
            $category->image()->update([
                'image' => FilesTrait::store($data['image'], Category::IMG_URL),
            ]);
        }
        return $category;
    }

    public function destroy($category)
    {
        $category->image()->delete();
        $category->delete();
        return true;
    }
}
