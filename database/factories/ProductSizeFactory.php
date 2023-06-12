<?php

namespace Database\Factories;

use App\Enums\SiblingType;
use App\Enums\Size;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductSize>
 */
class ProductSizeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => $this->faker->numberBetween(55, 120),
            'value' => $this->faker->randomElement(Size::getValues()),
            'stock' => $this->faker->numberBetween(null, 100),
        ];
    }
}
