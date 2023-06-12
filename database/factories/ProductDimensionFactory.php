<?php

namespace Database\Factories;

use App\Enums\DimensionType;
use App\Enums\DimensionUnit;
use App\Enums\Size;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductDimension>
 */
class ProductDimensionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => $this->faker->numberBetween(50, 150),
            'type' => $this->faker->randomElement(DimensionType::getValues()),
            'value' => $this->faker->randomFloat(),
            'unit' => $this->faker->randomElement(DimensionUnit::getValues()),
            'stock' => $this->faker->numberBetween(null, 100),
        ];
    }
}
