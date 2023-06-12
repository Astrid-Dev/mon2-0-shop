<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bookmark>
 */
class BookmarkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 180),
            'element_type' => $this->faker->randomElement([Provider::class, Product::class]),
            'element_id' => $this->faker->numberBetween(1, 150),
        ];
    }
}
