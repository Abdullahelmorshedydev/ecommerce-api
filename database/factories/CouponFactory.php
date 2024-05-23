<?php

namespace Database\Factories;

use App\Enums\CouponTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => fake()->word(),
            'type' => fake()->randomElement(CouponTypeEnum::cases()),
            'value' => 10,
            'max_usage' => 5,
            'number_of_usage' => 0,
            'min_order_value' => 500,
            'expire_date' => '2025/12/12',
        ];
    }
}
