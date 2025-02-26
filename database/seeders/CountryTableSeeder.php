<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::insert([
            ['country_name' => 'Indonesia', 'status' => 'active'],
            ['country_name' => 'United States', 'status' => 'active'],
            ['country_name' => 'Canada', 'status' => 'active'],
            ['country_name' => 'Australia', 'status' => 'inactive'],
            ['country_name' => 'Germany', 'status' => 'active'],
        ]);
    }
}
