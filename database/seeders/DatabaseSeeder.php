<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. បង្កើត Admin User សម្រាប់ Login សាកល្បង
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'), // កំណត់ password ងាយស្រួលចាំ
        ]);

        // 2. បង្កើត Categories (ប្រភេទកុំព្យូទ័រ)
        $laptop = Category::create(['name' => 'Laptops']);
        $desktop = Category::create(['name' => 'Desktops']);
        $accessory = Category::create(['name' => 'Accessories']);

        // 3. បង្កើត Products គំរូ
        Product::create([
            'category_id' => $laptop->id,
            'name' => 'MSI Katana 15',
            'brand' => 'MSI',
            'price' => 999.00,
            'stock' => 5,
            'description' => 'Gaming laptop with RTX 4060 and Intel i7.',
        ]);

        Product::create([
            'category_id' => $laptop->id,
            'name' => 'MacBook Air M2',
            'brand' => 'Apple',
            'price' => 1199.00,
            'stock' => 10,
            'description' => 'Slim and powerful with Apple Silicon.',
        ]);

        Product::create([
            'category_id' => $accessory->id,
            'name' => 'ROG Gladius III',
            'brand' => 'ASUS',
            'price' => 85.00,
            'stock' => 20,
            'description' => 'High-precision gaming mouse.',
        ]);
    }
}