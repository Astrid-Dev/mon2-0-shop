<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Provider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $providers = Provider::all();

        foreach ($providers as $provider) {
            $numberOfProducts = fake()->numberBetween(0, 7);
            $provider->products()->createMany(
                Product::factory($numberOfProducts)->make(['provider_id' => $provider->id])->toArray()
            );
        }
    }
}
