<?php

namespace Database\Factories;

use App\Enums\StockType;
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
            'name' => $this->faker->words(8, true),
            'description' => $this->faker->paragraph('3'),
            'price' => $this->faker->randomFloat(2, 500, 9000),
            'details' => $this->faker->words($this->faker->numberBetween(0, 7)),
            'tags' => $this->faker->words($this->faker->numberBetween(0, 4)),
            'stock_type' => $this->faker->randomElement(StockType::getValues()),
            'brand_id' => $this->faker->numberBetween(1, 15),
            'category_id' => $this->faker->numberBetween(6, 52),
        ];
    }
}
