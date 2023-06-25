<?php

namespace Database\Factories;

use App\Enums\ProviderStatus;
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
            'code' => $this->faker->unique()->creditCardNumber(),
            'name' => $this->faker->company(),
            'phone1' => $this->faker->e164PhoneNumber(),
            'phone2' => $this->faker->e164PhoneNumber(),
            'whatsapp' => str_replace(' ', '', str_replace('+', '', $this->faker->e164PhoneNumber())),
            'city' => $this->faker->city(),
            'address' => $this->faker->address(),
            'user_id' => $this->faker->unique()->numberBetween(15, 150),
            'status' => ProviderStatus::APPROVED,
            'description' => $this->faker->paragraph(2),
            'logo' => $this->faker->imageUrl()
        ];
    }
}
