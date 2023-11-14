<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Services\NewsDataService;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categoriesData = [
            'business',
            'crime',
            'domestic',
            'education',
            'entertainment',
            'environment',
            'food',
            'health',
            'other',
            'politics',
            'science',
            'sports',
            'technology',
            'top',
            'tourism',
            'world',
        ];

        foreach ($categoriesData as $category) {
            \App\Models\Category::create([
                'name' => $category,
            ]);
        }
    }
}
