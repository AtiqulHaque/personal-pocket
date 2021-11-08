<?php

namespace App\Services\Crawler;

class SiteUrl
{
    private $fullUrl;

    public function __construct($url)
    {
        $this->fullUrl = $url;
    }

    /**
     * @return mixed
     */
    public function getFullUrl()
    {
        return $this->fullUrl;
    }


}
