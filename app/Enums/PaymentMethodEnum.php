<?php

namespace App\Enums;

enum PaymentMethodEnum: int
{
    case CASH = 1;

    public static function values(): array
    {
        return [
            self::CASH->value,
        ];
    }

    public function lang(): string
    {
        return match ($this)
        {
            self::CASH => 'CASH',
        };
    }
}
