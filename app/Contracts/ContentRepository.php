<?php

namespace App\Contracts;

use App\Models\SiteContent;
use App\Services\HtmlResponse;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ContentRepository.
 *
 * @package namespace App\Contracts;
 */
interface ContentRepository extends RepositoryInterface
{
    /**
     * @param $siteId
     * @param HtmlResponse $response
     * @return mixed
     */
    public function createSiteContent($siteId, HtmlResponse $response);
}
