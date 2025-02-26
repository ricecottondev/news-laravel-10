<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menambahkan minimal 10 entri ke tabel countries_categories
        DB::table('countries_categories')->insert([
            ['country_id' => 1, 'category_id' => 1, 'status' => 'active'],
            ['country_id' => 1, 'category_id' => 2, 'status' => 'active'],
            ['country_id' => 2, 'category_id' => 1, 'status' => 'active'],
            ['country_id' => 2, 'category_id' => 3, 'status' => 'inactive'],
            ['country_id' => 3, 'category_id' => 2, 'status' => 'active'],
            ['country_id' => 3, 'category_id' => 4, 'status' => 'active'],
            ['country_id' => 4, 'category_id' => 1, 'status' => 'inactive'],
            ['country_id' => 4, 'category_id' => 5, 'status' => 'active'],
            ['country_id' => 5, 'category_id' => 3, 'status' => 'active'],
            ['country_id' => 5, 'category_id' => 4, 'status' => 'inactive'],
        ]);
    }
}
