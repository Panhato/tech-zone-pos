<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // បញ្ជីឈ្មោះប្រភេទដែលអ្នកចង់បង្កើត
        $categories = [
            'Laptops',
            'Desktops',
            'Gaming PCs',
            'Accessories',
            'Monitors', // អ្នកអាចបន្ថែមកុំព្យូទ័រម៉ូតផ្សេងៗទៀតនៅទីនេះ
        ];

        foreach ($categories as $category) {
            // ប្រើ firstOrCreate ដើម្បីការពារកុំឱ្យវាបញ្ចូលឈ្មោះដដែលៗនាំឱ្យជាប់ Error
            Category::firstOrCreate(['name' => $category]);
        }
    }
}