<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    public function run()
    {
        $countriesData = [
            ['name' => 'Belgium', 'code' => 'be', 'languages' => ['nl']],
            ['name' => 'Canada', 'code' => 'ca', 'languages' => ['en', 'fr']],
            ['name' => 'France', 'code' => 'fr', 'languages' => ['fr']],
            ['name' => 'Germany', 'code' => 'de', 'languages' => ['de']],
            ['name' => 'United Kingdom', 'code' => 'gb', 'languages' => ['en']],
        ];

        foreach ($countriesData as $countryData) {
            $country = \App\Models\Country::create([
                'name' => $countryData['name'],
                'code' => $countryData['code'],
            ]);

            // Attach languages to the country
            foreach ($countryData['languages'] as $languageCode) {
                $language = \App\Models\Language::where('language', $languageCode)->first();
                if ($language) {
                    $country->languages()->attach($language->id);
                }
            }
        }
    }
}
