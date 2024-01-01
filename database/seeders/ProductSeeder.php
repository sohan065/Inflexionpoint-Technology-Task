<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed products
        Product::create([
            'name' => 'Product 1',
            'price' => 19.99,
            'quantity' => 100,
            'category_id' => 1,
        ]);

        Product::create([
            'name' => 'Product 2',
            'price' => 29.99,
            'quantity' => 50,
            'category_id' => 2,
        ]);
    }
}
