<?php

namespace App\Services\Crawler;

use App\Contracts\Service\CrawlerServiceContract;
use App\Contracts\Service\ResponseProcessor;
use DOMDocument;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class CrawlerService implements CrawlerServiceContract
{

    /**
     * @var Client
     */
    private $httpClient;
    private $siteUrl;
    /**
     * @var ResponseProcessor
     */
    private $responseProcessor;

    public function __construct()
    {
        $this->httpClient = new Client();
    }


    /**
     * @param SiteUrl $url
     * @return $this
     */
    public function setSiteUrl(SiteUrl $url)
    {
        $this->siteUrl = $url;
        return $this;
    }

    /**
     * @param ResponseProcessor $responseProcessor
     * @return CrawlerService
     */
    public function setResponseProcessor(ResponseProcessor $responseProcessor)
    {
        $this->responseProcessor = $responseProcessor;
        return $this;
    }

    /**
     * @return HtmlResponse
     * @throws GuzzleException
     * @throws Exception
     */
    public function crawl()
    {
        $response = $this->httpClient->get($this->siteUrl->getFullUrl());
        $htmlString = (string) $response->getBody();
        libxml_use_internal_errors(true);
        $doc = new DOMDocument();
        try {
            $doc->loadHTML($htmlString);
            return $this->responseProcessor->processResponse($doc, $this->siteUrl);
        } catch (Exception $ex) {
            Log::error("Error occurred while parsing the content.", [$ex]);
            throw new Exception();
        }
    }
}
