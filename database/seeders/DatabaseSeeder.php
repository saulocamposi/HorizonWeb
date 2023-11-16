<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Category;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        Country::factory(5)->create()->each(function ($country) {
            $categories = Category::factory(3)->create();
            $country->categories()->attach($categories);
        });
    }
}
