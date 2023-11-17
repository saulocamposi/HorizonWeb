<?php

namespace App\Http\Controllers;

use App\Exceptions\GeneralJsonException;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Category;

class CountryController extends Controller
{
    public function getAllCountries()
    {
        $countries = Country::with(['languages' => function ($query) {
            $query->select('language')->without('pivot');
        }, 'categories' => function ($query) {
            $query->select('name');
        }])
            ->select('id', 'name', 'code')
            ->get();

        $countries = $countries->makeHidden('id');

        $countries = array_map(function ($country) {
            $country['languages'] = array_map(function ($language) {
                return array_diff_key($language, ['pivot' => null]);
            }, $country['languages']);

            $country['categories'] = array_map(function ($categories) {
                return array_diff_key($categories, ['pivot' => null]);
            }, $country['categories']);

            return array_diff_key($country, ['id' => null]);
        }, $countries->toArray());

        return response()->json(['countries' => $countries]);
    }

    public function getCountryDetails($code)
    {
        $country = Country::where('code', $code)->with(['languages', 'categories'])->first();

        return response()->json(['country' => $country]);
    }

    public function addCountryCategory(Request $r, $countryCode)
    {
        $category = $r->input('category');
        $country = Country::where('code', $countryCode)->first();

        throw_if(!$country, GeneralJsonException::class, 'Country not found', 404);

        throw_if(!$category, GeneralJsonException::class, 'Category name is required', 400);

        $category = Category::where('name', $category)->first();

        throw_if(!$category, GeneralJsonException::class, 'Category not valid', 400);
        $country->categories()->syncWithoutDetaching($category->id);

        return response()->json(['categories' => $country->categories]);
    }

    public function removeCountryCategory($countryCode, $category)
    {

        $country = Country::where('code', $countryCode)->first();

        if (!$country) {
            return response()->json(['message' => 'Country not found'], 404);
        }

        if (!$category) {
            return response()->json(['message' => 'Category name is required'], 400);
        }

        $category = Category::where('name', $category)->first();
        if (!$category) {
            return response()->json(['message' => 'Category not valid'], 400);
        }

        $country->categories()->detach($category->id);


        return response()->json(['message' => 'Category {$category} removed'], 200);
    }

    public function listAllCategories()
    {
        return response()->json(['categories' => Category::all()]);
    }
}
