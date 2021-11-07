<?php

namespace App\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface TagRepository.
 *
 * @package namespace App\Contracts;
 */
interface TagRepository extends RepositoryInterface
{
    //
    public function findOrCreate(array $hashes);

    public function attachTags($siteId, array $hashes);

    public function getContentByTags($tagNames);
}
