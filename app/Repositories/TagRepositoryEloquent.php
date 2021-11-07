<?php

namespace App\Repositories;

use App\Contracts\TagRepository;
use App\Models\SiteContent;
use App\Models\SitesTags;
use App\Models\Tag;
use App\Validators\TagValidator;
use Illuminate\Http\Resources\Json\PaginatedResourceResponse;
use Illuminate\Support\Collection;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class TagRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TagRepositoryEloquent extends BaseRepository implements TagRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Tag::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param array $hashes
     * @return array
     */
    public function findOrCreate(array $hashes)
    {
        $results = $this->model->whereIn('name', $hashes)->get();

        if ($results->count() === count($hashes)) {
            return $results->pluck('id')->toArray();
        }

        $needToInsert = array_diff($hashes, $results->pluck('name')->toArray());

        $multiContent = [];

        foreach ($needToInsert as $items) {
            $multiContent[] = ['name' => $items];
        }

        $this->model->insert($multiContent);


        return $this->model->whereIn('name', $hashes)->get()->pluck('id')->toArray();
    }

    /**
     * @param $siteModel
     * @param array $hashes
     * @return bool
     */
    public function attachTags($siteModel, array $hashes)
    {
        $tagIds = $this->findOrCreate($hashes);
        return $siteModel->tags()->attach($tagIds);
    }

    /**
     * @param $tagNames
     * @return Collection
     */
    public function getContentByTags($tagNames)
    {
        $tags = $this->model->whereIn('name', $tagNames)->get();
        $siteIds = [];
        if (!empty($tags)) {
            $tagIds =  $tags->pluck('id')->toArray();
            $siteIds = SitesTags::whereIn('tag_id', $tagIds)->get('site_id');
        }

        return SiteContent::whereIn('id', $siteIds)->with(['contents'])->paginate();
    }
}
