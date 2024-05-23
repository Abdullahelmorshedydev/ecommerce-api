<?php

namespace App\Services\Api\Back;

use App\Models\Product;
use App\Traits\FilesTrait;

class ProductService
{
    use FilesTrait;

    public function index()
    {
        return Product::paginate();
    }

    public function store($data)
    {
        $product = Product::create($data);
        foreach ($data['colors'] as $color) {
            $product->colors()->create($color);
        }
        if (isset($data['images'])) {
            foreach ($data['images'] as $image) {
                $product->images()->create([
                    'image' => FilesTrait::store($image, Product::IMG_URL),
                ]);
            }
        }
        return $product;
    }

    public function update($product, $data)
    {
        $product->update($data);
        if (isset($data['colors'])) {
            $product->colors()->delete();
            foreach ($data['colors'] as $color) {
                $product->colors()->create([
                    'name' => $color['name'],
                    'code' => $color['code'],
                ]);
            }
        }
        if (isset($data['images'])) {
            foreach ($data['images'] as $key => $image) {
                $product->images()->where('id', $key)->first()->update([
                    'image' => FilesTrait::store($image, Product::IMG_URL),
                ]);
            }
        }
        return $product;
    }

    public function destroy($product)
    {
        $product->images()->delete();
        $product->delete();
        return true;
    }
}
