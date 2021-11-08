<?php

namespace App\Jobs;

use App\Contracts\ContentRepository;
use App\Models\SiteContent;
use App\Services\Crawler\CrawlerService;
use App\Services\Crawler\HtmlResponseProcessor;
use App\Services\Crawler\SiteUrl;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Log;

class CrawlWebsite implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var SiteContent
     */
    private $siteContent;
    /**
     * @var ContentRepository
     */
    private $contentRepo;
    private $siteId;
    private $siteURL;

    /**
     * Create a new job instance.
     *
     * @param $siteId
     * @param $siteURL
     */
    public function __construct($siteId, $siteURL)
    {
        $this->siteId = $siteId;
        $this->siteURL = $siteURL;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws GuzzleException
     */
    public function handle()
    {
        Log::info("Site Crawling  Start for ".$this->siteURL);

        try {
            $this->contentRepo = App::make(ContentRepository::class);
            $crawler = new CrawlerService();
            $crawler->setSiteUrl(new SiteUrl($this->siteURL));
            $crawler->setResponseProcessor(new HtmlResponseProcessor());
            $response = $response = $crawler->crawl();
            $this->contentRepo->createSiteContent($this->siteId, $response);
        } catch (Exception $ex) {
            Log::info("Error occurred while site crawling ".$this->siteURL, [$ex]);
        }

        Log::info("Site Crawling  finished for ".$this->siteURL);
    }
}
