<?php

namespace Database\Factories;

use App\Enums\DiscountTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->paragraph(6),
            'price' => 100,
            'quantity' => 1,
            'category_id' => rand(1, 10),
        ];
    }
}
