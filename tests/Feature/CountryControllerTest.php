<?php

namespace Tests\Feature;

use App\Exceptions\GeneralJsonException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Country;
use App\Models\Category;
use Exception;

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

    public function testExceptionCountryNotFound()
    {
        $this->expectException(GeneralJsonException::class);
        $this->expectExceptionMessage('Country not found');
        $category = Category::factory()->create();
        $this->withoutExceptionHandling()->post("api/country/1", ['category' => $category->name]);
    }

    public function testExceptionCategoryNotFound()
    {
        $this->expectException(GeneralJsonException::class);
        $this->expectExceptionMessage('Category name is required');
        $country = Country::factory()->create();
        $this->withoutExceptionHandling()->post("api/country/{$country->code}", ['category' => '']);
    }
}
