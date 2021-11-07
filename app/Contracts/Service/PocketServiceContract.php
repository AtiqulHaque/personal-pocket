<?php
namespace App\Contracts\Service;

interface PocketServiceContract
{
    /**
     * @return mixed
     */
    public function getPocketList();

    /**
     * @param $title
     * @return mixed
     */
    public function createPocket($title);


    public function getPocketDetails($pocket_id);
}
