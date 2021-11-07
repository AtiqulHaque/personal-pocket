<?php

namespace App\Repositories;

use App\Models\SiteContent;
use App\Services\HtmlResponse;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\ContentRepository;
use App\Models\Content;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class ContentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ContentRepositoryEloquent extends BaseRepository implements ContentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Content::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param $siteId
     * @param HtmlResponse $response
     * @return Content
     * @throws ValidatorException
     */
    public function createSiteContent($siteId, HtmlResponse $response)
    {
        return $this->create([
            'site_id' => $siteId,
            'title' => $response->getTitle(),
            'excerpt' => $response->getExcerpt(),
            'head_image' => $response->getImg(),
        ]);
    }
}
