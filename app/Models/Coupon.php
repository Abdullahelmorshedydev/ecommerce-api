<?php

namespace App\Models;

use App\Enums\CouponStatusEnum;
use App\Enums\CouponTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupons';

    protected $fillable = [
        'code',
        'value',
        'max_usage',
        'number_of_usage',
        'min_order_value',
        'type',
        'expire_date',
        'status',
    ];

    protected $casts = [
        'type' => CouponTypeEnum::class,
        'status' => CouponStatusEnum::class,
    ];
}
