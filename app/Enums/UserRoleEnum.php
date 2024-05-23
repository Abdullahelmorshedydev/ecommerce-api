<?php

namespace App\Enums;

enum UserRoleEnum: int
{
    case USER = 1;
    case ADMIN = 2;

    public static function values(): array
    {
        return [
            self::USER->value,
            self::ADMIN->value,
        ];
    }

    public function lang(): string
    {
        return match ($this)
        {
            self::USER => 'User',
            self::ADMIN => 'Admin',
        };
    }
}
