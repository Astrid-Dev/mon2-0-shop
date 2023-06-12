<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Provider>
 */
class ProviderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'phone' => $this->faker->e164PhoneNumber(),
            'whatsapp' => $this->faker->url(),
            'city' => $this->faker->city(),
            'address' => $this->faker->address(),
            'user_id' => $this->faker->unique()->numberBetween(15, 150),
        ];
    }
}
