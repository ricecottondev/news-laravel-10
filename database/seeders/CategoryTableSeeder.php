<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menambahkan minimal 5 kategori
        $categories = [
            ['name' => 'Technology', 'description' => 'All about technology'],
            ['name' => 'Health', 'description' => 'Health and wellness topics'],
            ['name' => 'Sports', 'description' => 'Latest sports news and updates'],
            ['name' => 'Entertainment', 'description' => 'Movies, music, and more'],
            ['name' => 'Science', 'description' => 'Scientific discoveries and news'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
