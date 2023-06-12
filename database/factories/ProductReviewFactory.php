<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductReview>
 */
class ProductReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => $this->faker->numberBetween(1, 150),
            'user_id' => $this->faker->numberBetween(1, 180),
            'rating' => $this->faker->randomFloat(1, 1, 5),
            'comment' => $this->faker->paragraph()
        ];
    }
}
