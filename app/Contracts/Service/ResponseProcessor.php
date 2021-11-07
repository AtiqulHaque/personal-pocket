<?php


namespace App\Contracts\Service;

use App\Services\HtmlResponse;

interface ResponseProcessor
{
    /**
     * @param $htmlDoc
     * @param $siteUrl
     * @return HtmlResponse
     */
    public function processResponse($htmlDoc, $siteUrl);
}
