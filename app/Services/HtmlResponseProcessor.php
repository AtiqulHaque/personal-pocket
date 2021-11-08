<?php

namespace App\Services;

use App\Contracts\ContentRepository;
use App\Contracts\Service\ResponseProcessor;
use App\Contracts\SiteContentRepository;
use DOMXPath;

class HtmlResponseProcessor implements ResponseProcessor
{

    /**
     * @param $htmlDoc
     * @param $siteUrl
     * @return HtmlResponse
     */
    public function processResponse($htmlDoc, $siteUrl)
    {
        $xpath      = new DOMXPath($htmlDoc);
        $response   = new HtmlResponse();
        $title      = $xpath->evaluate('//h1');
        $excerpt    = $xpath->evaluate('//p');
        $img        = $xpath->evaluate('//header//img');

        if (!empty($img->item(0)) && !empty($img->item(0)->getAttribute('src'))) {
            $response->setImg(substr($img->item(0)->getAttribute('src'), 0, 145));
        }
        if (!empty($title->item(0)) && !empty($title->item(0)->nodeValue)) {
            $response->setTitle(substr($title->item(0)->nodeValue, 0, 150));
        }

        if (!empty($excerpt->item(0)) && !empty($excerpt->item(0)->nodeValue)) {
            $response->setExcerpt(substr($excerpt->item(0)->nodeValue, 0, 500));
        }

        return $response;
    }
}
