<?php

namespace Database\Seeders;

use App\Models\ProductPromotion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductPromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductPromotion::factory(80)->create();
    }
}
