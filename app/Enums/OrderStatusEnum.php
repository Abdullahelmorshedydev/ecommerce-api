<?php

namespace App\Enums;

enum OrderStatusEnum: int
{
    case PENDING = 1;
    case PROCCESSING = 2;
    case COMPLETED = 3;
    case CANCELED = 4;
    case SHIPPED = 5;

    public static function values(): array
    {
        return [
            self::PENDING->value,
            self::PROCCESSING->value,
            self::COMPLETED->value,
            self::CANCELED->value,
            self::SHIPPED->value,
        ];
    }

    public function icon(): string
    {
        return match ($this)
        {
            self::PENDING => 'fas fa-clock',
            self::PROCCESSING => 'fas fa-clock',
            self::COMPLETED => 'fa fa-check-circle',
            self::CANCELED => 'fas fa-times',
            self::SHIPPED => 'fas fa-shipping-fast',
        };
    }

    public function adminButtonClass(): string
    {
        return match ($this)
        {
            self::PENDING => 'btn btn-info',
            self::PROCCESSING => 'btn btn-primary',
            self::COMPLETED => 'btn btn-success',
            self::SHIPPED => 'btn btn-success',
        };
    }

    public function adminButtonLink(): string
    {
        return match ($this)
        {
            self::PENDING => 'admin.orders.proccess',
            self::PROCCESSING => 'admin.orders.ship',
            self::COMPLETED => '#',
            self::CANCELED => '#',
            self::SHIPPED => 'admin.orders.complete',
        };
    }

    public function adminButtonLang(): string
    {
        return match ($this)
        {
            self::PENDING => 'Proccess',
            self::PROCCESSING => 'Ship',
            self::COMPLETED => '#',
            self::CANCELED => '#',
            self::SHIPPED => 'Complete',
        };
    }

    public function lang(): string
    {
        return match ($this)
        {
            self::PENDING => 'Pending',
            self::PROCCESSING => 'Proccessing',
            self::COMPLETED => 'Completed',
            self::CANCELED => 'Canceled',
            self::SHIPPED => 'Shipped',
        };
    }
}
