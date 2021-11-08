<?php


namespace App\Contracts\Service;

use App\Services\Crawler\HtmlResponse;
use App\Services\Crawler\SiteUrl;

interface ResponseProcessor
{
    /**
     * @param $htmlDoc
     * @param SiteUrl $siteUrl
     * @return HtmlResponse
     */
    public function processResponse($htmlDoc, SiteUrl $siteUrl);
}
