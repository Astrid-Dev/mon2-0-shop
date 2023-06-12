<?php

namespace Database\Seeders;

use App\Models\ProductSibling;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSiblingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductSibling::factory(200)->create();
    }
}
