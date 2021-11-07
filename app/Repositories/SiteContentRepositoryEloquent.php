<?php

namespace App\Repositories;

use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\SiteContentRepository;
use App\Models\SiteContent;
use App\Validators\SiteContentValidator;

/**
 * Class SiteContentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SiteContentRepositoryEloquent extends BaseRepository implements SiteContentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SiteContent::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return SiteContentValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param $packetId
     * @return LengthAwarePaginator
     */
    public function getContentByPocketId($packetId)
    {
        return $this->model->with(['contents'])->where('pocket_id', $packetId)->paginate();
    }

    /**
     * @param $params
     * @return SiteContent
     * @throws Exception
     */
    public function createPocketContent($params)
    {
        try {
            return $this->create($params);
        } catch (Exception $e) {
            Log::error("Error occurred when creating pocket from repository.", [$e]);
            throw new Exception('Exception occurred Creating pocket failed');
        }
    }

    /**
     * @param $site_url
     * @return bool
     * @throws Exception
     */
    public function deleteContentByUrl($site_url)
    {

        try {
            return $this->model->where('site_url', $site_url)->delete();
        } catch (Exception $e) {
            Log::error("Error occurred when deleting content from pocket.", [$e]);
            throw new Exception('Error occurred when deleting content from pocket');
        }
    }
}
