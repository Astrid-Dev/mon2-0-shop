<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(200)->create();

        $this->call([
            BrandSeeder::class,
            CategorySeeder::class,
            BookmarkSeeder::class,
            ProviderSeeder::class,
            ProductSeeder::class,
            ProductColorSeeder::class,
            ProductDimensionSeeder::class,
            ProductReviewSeeder::class,
            ProductSizeSeeder::class,
            ProductSiblingSeeder::class,
            ProductPromotionSeeder::class
        ]);
    }
}
