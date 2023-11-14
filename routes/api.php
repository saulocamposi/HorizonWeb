<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\NewsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/countries', [CountryController::class, 'getAllCountries']);
Route::get('/country/{code}', [CountryController::class, 'getCountryDetails']);

Route::get('/news/{countryCode}/{language}/{category}', [NewsController::class, 'getPaginatedNews']);
Route::get('/news/{countryCode}/{page}', [NewsController::class, 'getPaginatedNews']);

Route::post('/country/{countryCode}/{category}', [CountryController::class, 'addCategory']);
Route::delete('/country/{countryCode}/{category}', [CountryController::class, 'removeCategory']);
