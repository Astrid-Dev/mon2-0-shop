<?php

namespace Database\Factories;

use App\Enums\SiblingType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductSibling>
 */
class ProductSiblingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => $this->faker->numberBetween(60, 120),
            'sibling' => $this->faker->randomElement(SiblingType::getValues()),
            'stock' => $this->faker->numberBetween(null, 10),
        ];
    }
}
