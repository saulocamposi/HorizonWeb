<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use NewsdataIO\NewsdataApi;

class NewsDataService
{
    protected $newsdataApiObj;

    public function __construct()
    {
        $apiKey = env('NEWSDATA_API_KEY');
        $this->newsdataApiObj = new NewsdataApi($apiKey);
    }

    public function getNewsData($countryCode, $language = null, $category = null)
    {
        $data = array("country" => $countryCode);
        $response = $this->newsdataApiObj->get_latest_news($data);
        return $response;
    }

    public function getNewsArticles($countryCode, $language, $category)
    {
        $data = array("language" => $language, "country" => $countryCode, 'category' => $category);
        $newsArticles = $this->newsdataApiObj->get_latest_news($data);
        return $newsArticles;
    }
}
