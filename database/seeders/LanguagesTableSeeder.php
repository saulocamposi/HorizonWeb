<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    public function run()
    {
        $languagesData = ['nl', 'en', 'fr', 'de'];

        foreach ($languagesData as $languageCode) {
            \App\Models\Language::create([
                'language' => $languageCode,
            ]);
        }
    }
}
