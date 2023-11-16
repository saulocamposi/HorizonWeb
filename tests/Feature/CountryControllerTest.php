<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Country;
use App\Models\Category;

class CountryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_add_category_to_country()
    {
        $country = Country::factory()->create();
        $category = Category::factory()->create();
        $response = $this->post("api/country/{$country->code}", ['category' => $category->name]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('country_category', [
            'country_id' => $country->id,
            'category_id' => $category->id,
        ]);
    }

    public function test_remove_category_from_country()
    {

        $country = Country::factory()->create();
        $category = Category::factory()->create();
        $country->categories()->attach($category);

        $response = $this->delete("api/country/{$country->code}/$category->name", ['category_name' => $category->name]);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('country_category', [
            'country_id' => $country->id,
            'category_id' => $category->id,
        ]);
    }
}
