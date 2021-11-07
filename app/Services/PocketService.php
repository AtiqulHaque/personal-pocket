<?php

namespace App\Services;

use App\Contracts\PocketRepository;
use App\Contracts\Service\PocketServiceContract;
use App\Validators\PocketValidator;
use Exception;

class PocketService implements PocketServiceContract
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


    /**
     * @return array
     */

    public function getPocketList()
    {
        return [
            "status" => 'success',
            'data'   => $this->pocketRepo->getAll()
        ];
    }

    /**
     * @param string $title
     * @return array
     */
    public function createPocket($title)
    {
        $this->validator->setCreatePocketRules();

        if (!$this->validator->with(['title' => $title])->passes()) {
            return [
                'html'   => "Creating pocket validation errors",
                'status' => 'validation-error',
                'error'  => $this->validator->errors()->messages()
            ];
        }

        try {
            $pocket = $this->pocketRepo->createPocket($title);
            if (!empty($pocket)) {
                return [
                    "status" => 'success',
                    'data'   => $pocket
                ];
            } else {
                return [
                    "status" => 'error',
                    'data'   => null
                ];
            }
        } catch (Exception $e) {
            return [
                "status" => 'error',
                'html'   => "Something went wrong!!! while creating pocket"
            ];
        }
    }
}
