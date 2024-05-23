<?php

namespace App\Models;

use App\Enums\DiscountTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    const IMG_URL = '/products';

    protected $fillable = [
        'name',
        'category_id',
        'price',
        'description',
        'quantity',
        'sales_count',
        'discount',
        'discount_type',
    ];

    protected $casts = [
        'discount_type' => DiscountTypeEnum::class,
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function colors()
    {
        return $this->hasMany(ProductColor::class);
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function images() : MorphMany
    {
        return $this->morphMany(Image::class, 'morphable');
    }

    public function getImagesAttribute()
    {
        $images = [];
        foreach ($this->images()->get() as $image) {
            $images[] = Storage::url($image->image);
        }
        return $images;
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function getInWishlistAttribute()
    {
        foreach ($this->wishlists as $wishlist) {
            if (auth()->user()) {
                if (auth()->user()->id == $wishlist->user_id) {
                    return true;
                }
            }
        }
        return false;
    }

    public function getInCartAttribute()
    {
        foreach ($this->carts as $cart) {
            if (auth()->user()) {
                if (auth()->user()->id == $cart->user_id) {
                    return true;
                }
            }
        }
        return false;
    }
}
