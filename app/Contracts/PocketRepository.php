<?php

namespace App\Contracts;

use App\Models\Pocket;
use Exception;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface PocketRepository.
 *
 * @package namespace App\Contracts;
 */
interface PocketRepository extends RepositoryInterface
{
    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @param $title
     * @return Pocket
     * @throws Exception
     */
    public function createPocket($title);
}
