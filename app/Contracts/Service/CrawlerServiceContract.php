<?php
namespace App\Contracts\Service;

use App\Services\Crawler\SiteUrl;

/**
 * Interface CrawlerServiceContract
 * @package App\Contracts\Service
 */
interface CrawlerServiceContract
{
    public function setSiteUrl(SiteUrl $url);

    /**
     * @param ResponseProcessor $responseProcessor
     * @return mixed
     */
    public function setResponseProcessor(ResponseProcessor $responseProcessor);


    public function crawl();
}
