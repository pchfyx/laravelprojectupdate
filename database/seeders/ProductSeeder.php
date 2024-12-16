<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Create example categories
        $categories = Category::factory()->count(3)->create();

        // Create example products
        Product::factory()->count(30)->create([
            'category_id' => Category::inRandomOrder()->first()->id,
        ]);
    }
}

