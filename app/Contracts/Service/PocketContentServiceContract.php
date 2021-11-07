<?php
namespace App\Contracts\Service;

use App\Models\SiteContent;
use Illuminate\Support\Collection;

interface PocketContentServiceContract
{
    /**
     * @param $packetId
     * @return Collection
     */
    public function getSiteContentByPocketId($packetId);

    /**
     * @param $params
     * @return SiteContent
     */
    public function createPocketContent(array $params);


    /**
     * @param array $params
     * @return Collection
     */
    public function getSiteContentByHashTag(array $params);


    /**
     * @param array $params
     * @return bool
     */
    public function deleteContentByUrl(array $params);
}
