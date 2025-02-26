<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesCategoriesNewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menambahkan minimal 10 entri ke tabel countries_categories_news
        DB::table('countries_categories_news')->insert([
            [
                'country_id' => 1, // Ganti dengan ID negara yang sesuai
                'category_id' => 1, // Ganti dengan ID kategori yang sesuai
                'news_id' => 1,     // Ganti dengan ID berita yang sesuai
                'status' => 'active',
            ],
            [
                'country_id' => 1,
                'category_id' => 2,
                'news_id' => 2,
                'status' => 'active',
            ],
            [
                'country_id' => 2,
                'category_id' => 1,
                'news_id' => 3,
                'status' => 'active',
            ],
            [
                'country_id' => 2,
                'category_id' => 3,
                'news_id' => 4,
                'status' => 'active',
            ],
            [
                'country_id' => 3,
                'category_id' => 2,
                'news_id' => 5,
                'status' => 'active',
            ],
            [
                'country_id' => 3,
                'category_id' => 1,
                'news_id' => 6,
                'status' => 'active',
            ],
            [
                'country_id' => 4,
                'category_id' => 3,
                'news_id' => 7,
                'status' => 'active',
            ],
            [
                'country_id' => 4,
                'category_id' => 2,
                'news_id' => 8,
                'status' => 'active',
            ],
            [
                'country_id' => 5,
                'category_id' => 1,
                'news_id' => 9,
                'status' => 'active',
            ],
            [
                'country_id' => 5,
                'category_id' => 3,
                'news_id' => 10,
                'status' => 'active',
            ],
        ]);
    }
}
