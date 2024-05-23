<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => $this->category->name,
            'price' => $this->price,
            'description' => $this->description,
            'discount' => isset($this->discount) ? $this->discount : null,
            'discount_type' => isset($this->discount_type) ? $this->discount_type->lang() : null,
            'discount_format' => isset($this->discount) ? $this->discount . $this->discount_type->char() : null,
            'price_after_discount' => isset($this->discount) ? $this->discount_type->calc($this->price, $this->discount) : $this->price,
            'quantity' => $this->quantity,
            'sales_count' => $this->sales_count,
            'colors' => $this->colors,
            'reviews' => $this->reviews,
            'images' => $this->images,
        ];
    }
}
