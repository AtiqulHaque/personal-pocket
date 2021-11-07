<?php

namespace App\Services;

use App\Contracts\PocketRepository;
use App\Contracts\Service\PocketServiceContract;
use App\Contracts\Service\TagServiceContract;
use App\Validators\PocketValidator;
use Exception;

class TagService implements TagServiceContract
{

    private $pocketRepo;
    private $validator;

    /**
     * PocketService constructor.
     * @param PocketRepository $pocketRepo
     * @param PocketValidator $validator
     */
    public function __construct(PocketRepository $pocketRepo, PocketValidator $validator)
    {
        $this->pocketRepo = $pocketRepo;
        $this->validator = $validator;
    }

    public function createTag($title)
    {
        // TODO: Implement createTag() method.
    }
}
