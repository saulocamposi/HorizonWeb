<?php

namespace App\Http\Controllers;

use App\Services\NewsDataService;

class NewsController extends Controller
{
    protected $newsDataService;

    public function __construct(NewsDataService $newsDataService)
    {
        $this->newsDataService = $newsDataService;
    }

    public function getPaginatedNews($countryCode, $language, $category)
    {
        $newsData = $this->newsDataService->getNewsData($countryCode, $language, $category);
        return response()->json(['news' => $newsData]);
    }

    public function getNewsArticles($countryCode, $language, $category)
    {
        $newsData = $this->newsDataService->getNewsData($countryCode, $language, $category);
        return response()->json(['news' => $newsData]);
    }
}
