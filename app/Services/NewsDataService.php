<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use NewsdataIO\NewsdataApi;

class NewsDataService
{
    public function getNewsData($countryCode, $language = null, $category = null)
    {

        $newsdataApiObj = new NewsdataApi('pub_3283173d0e60a9e628e5a754c91551717106c');
        $data = array("country" => $countryCode);
        $response = $newsdataApiObj->get_latest_news($data);
        return $response;
    }

    public function getNewsArticles($countryCode, $language, $category)
    {
        $newsdataApiObj = new NewsdataApi('pub_3283173d0e60a9e628e5a754c91551717106c');
        $data = array("language" => $language, "country" => $countryCode, 'category' => $category);
        $newsArticles = $newsdataApiObj->get_latest_news($data);
        foreach ($newsArticles as $article) {
            # code...
        }
        return $newsArticles;
    }
}
