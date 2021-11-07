<?php

namespace App\Contracts;

use App\Models\SiteContent;
use Illuminate\Support\Collection;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface SiteContentRepository.
 *
 * @package namespace App\Contracts;
 */
interface SiteContentRepository extends RepositoryInterface
{
    /**
     * @param $packetId
     * @return Collection
     */
    public function getContentByPocketId($packetId);

    /**
     * @param $params
     * @return SiteContent
     */
    public function createPocketContent($params);

    /**
     * @param $site_url
     * @return bool
     */
    public function deleteContentByUrl($site_url);
}
