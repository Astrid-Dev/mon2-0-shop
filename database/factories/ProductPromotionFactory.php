<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductPromotion>
 */
class ProductPromotionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => $this->faker->numberBetween(15, 160),
            'start_date' => $this->faker->dateTimeBetween('now', '+2 weeks'),
            'end_date' => $this->faker->dateTimeBetween('+2 weeks', '+4 weeks'),
            'discount_percentage' => $this->faker->randomFloat(2, 1, 50),
        ];
    }
}
