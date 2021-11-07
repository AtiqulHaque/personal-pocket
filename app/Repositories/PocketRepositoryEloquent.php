<?php

namespace App\Repositories;

use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\PocketRepository;
use App\Models\Pocket;
use App\Validators\PocketValidator;

/**
 * Class PocketRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PocketRepositoryEloquent extends BaseRepository implements PocketRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Pocket::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @return Collection
     */
    public function getAll()
    {
        return $this->paginate();
    }

    /**
     * @param $title
     * @return Pocket
     * @throws Exception
     */
    public function createPocket($title)
    {
        try {
            return $this->create([
               'title' => $title,
               'status' => Pocket::STATUS_ENABLE
            ]);
        } catch (Exception $e) {
            Log::error("Error occurred when creating pocket from repository.", [$e]);
            throw new Exception('Exception occurred Creating pocket failed');
        }
    }
}
