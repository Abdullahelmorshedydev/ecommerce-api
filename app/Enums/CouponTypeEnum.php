<?php

namespace App\Enums;

enum CouponTypeEnum: int
{
    case FIXED = 1;
    case PERCENT = 2;

    public static function values(): array
    {
        return [
            self::FIXED->value,
            self::PERCENT->value,
        ];
    }

    public function lang(): string
    {
        return match ($this)
        {
            self::FIXED => 'FIXED',
            self::PERCENT => 'PERCENT',
        };
    }

    public function calc($price, $value): string
    {
        return match ($this) {
            self::FIXED => $price - $value,
            self::PERCENT => $price - $price * ($value / 100),
        };
    }
}
