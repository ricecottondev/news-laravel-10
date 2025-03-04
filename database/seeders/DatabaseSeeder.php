<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Permissions;
use Illuminate\Database\Seeder;
use NewsCommentSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            // UserSeeder::class,
            PermissionTableSeeder::class,
            CreateAdminUserSeeder::class,
            CountryTableSeeder::class,
            CategoryTableSeeder::class,
            NewsTableSeeder::class,
            CountriesCategoriesNewsTableSeeder::class,
            CountriesCategoriesTableSeeder::class,
            NewsCommentSeeder::class,
        ]);
    }
}
