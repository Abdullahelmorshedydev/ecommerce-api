<?php

namespace App\Enums;

enum DiscountTypeEnum: int
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
        return match ($this) {
            self::FIXED => 'FIXED',
            self::PERCENT => 'PERCENT',
        };
    }

    public function char(): string
    {
        return match ($this) {
            self::FIXED => 'EGP',
            self::PERCENT => '%',
        };
    }

    public function calc($price, $discount): int
    {
        return match ($this) {
            self::FIXED => $price - $discount,
            self::PERCENT => $price - ($price * ($discount / 100)),
        };
    }
}
