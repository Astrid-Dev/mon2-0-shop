<?php

namespace Database\Factories;

use App\Enums\Color;
use App\Enums\Size;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductColor>
 */
class ProductColorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => $this->faker->numberBetween(1, 100),
            'value' => $this->faker->randomElement(Color::getValues()),
            'stock' => $this->faker->numberBetween(null, 200),
        ];
    }
}
