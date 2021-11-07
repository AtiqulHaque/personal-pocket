<?php
namespace App\Contracts\Service;

/**
 * Interface CrawlerServiceContract
 * @package App\Contracts\Service
 */
interface CrawlerServiceContract
{
    public function setSiteUrl($url);

    /**
     * @param ResponseProcessor $responseProcessor
     * @return mixed
     */
    public function setResponseProcessor(ResponseProcessor $responseProcessor);


    public function crawl();
}
