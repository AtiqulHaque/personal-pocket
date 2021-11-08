<?php

namespace App\Services;

use App\Contracts\ContentRepository;
use App\Contracts\PocketRepository;
use App\Contracts\Service\PocketContentServiceContract;
use App\Contracts\Service\PocketServiceContract;
use App\Contracts\Service\ResponseProcessor;
use App\Contracts\SiteContentRepository;
use App\Contracts\TagRepository;
use App\Exceptions\CreateContentException;
use App\Exceptions\DeleteContentException;
use App\Exceptions\SiteContentNotFoundException;
use App\Jobs\CrawlWebsite;
use App\Validators\PocketValidator;
use Exception;
use Illuminate\Support\Facades\Log;

class PocketContentService implements PocketContentServiceContract
{

    private $pocketContentRepo;
    private $validator;
    /**
     * @var TagRepository
     */
    private $tagRepo;
    /**
     * @var ResponseProcessor
     */
    private $htmlResponseProcessor;
    /**
     * @var ContentRepository
     */
    private $contentRepo;

    /**
     * PocketService constructor.
     * @param SiteContentRepository $pocketContentRepo
     * @param TagRepository $tagRepo
     * @param PocketValidator $validator
     * @param ResponseProcessor $htmlResponseProcessor
     * @param ContentRepository $contentRepo
     */
    public function __construct(
        SiteContentRepository $pocketContentRepo,
        TagRepository $tagRepo,
        PocketValidator $validator,
        ResponseProcessor $htmlResponseProcessor,
        ContentRepository $contentRepo
    ) {
        $this->pocketContentRepo = $pocketContentRepo;
        $this->tagRepo = $tagRepo;
        $this->validator = $validator;
        $this->htmlResponseProcessor = $htmlResponseProcessor;
        $this->contentRepo = $contentRepo;
    }


    /**
     * @param $params
     * @return array
     */
    public function createPocketContent(array $params)
    {
        $this->validator->setCreatePocketContentRules();

        if (!$this->validator->with($params)->passes()) {
            return [
                'html'   => "Creating pocketContentData site validation errors",
                'status' => 'validation-error',
                'error'  => $this->validator->errors()->messages()
            ];
        }

        try {
            $pocketContentData = $this->pocketContentRepo->createPocketContent($params);
            //Split the hashes into array;

            if (!empty($params['hash'])) {
                $tags = explode(' ', trim($params['hash']));

                //remove white space from the array value
                $trimmedTags = array_unique(array_map(function ($item) {
                    return $this->removeHashtags($item);
                }, $tags));

               // if find  any hashtag then attach it to this site
                if (count($trimmedTags) > 0) {
                    $this->tagRepo->attachTags($pocketContentData, $trimmedTags);
                }
            }


            $crawlJob = new CrawlWebsite($pocketContentData->id, $pocketContentData->site_url);

            dispatch($crawlJob);

            return [
                "status" => 'success',
                'data'   => $pocketContentData
            ];
        } catch (CreateContentException $e) {
            Log::error("Error occurred while creating pocketContentData content.", [$e]);
            return [
                "status" => 'error',
                'html'   => "Something went wrong!!! while creating pocketContentData"
            ];
        }
    }

    /**
     * @param int $packetId
     * @return array
     */
    public function getSiteContentByPocketId($packetId)
    {
        try {
            return [
                "status" => 'success',
                'data'   => $this->pocketContentRepo->getContentByPocketId($packetId)
            ];
        } catch (SiteContentNotFoundException $e) {
            Log::error("Error occurred when getting pocket content.", [$e->getMessage()]);
            return [
                "status" => 'error',
                'html'   => "Something went wrong!!! while finding pocket"
            ];
        }
    }


    /**
     * @param $caption
     * @return string
     */
    protected function removeHashtags($caption)
    {
        // Get ready for some regex magic...
        return
            // Remove remaining hashes but keep the text inside the caption
            trim(str_replace(
                '#',
                '',
                trim(preg_replace(
                    '/^(.+?)#\w+$/m',
                    '${1}', // Edge case #hash1
                    trim(preg_replace(
                        '/^(.+?)#\w+ #\w+$/m',
                        '${1}', // Edge case #hash1 #hash2
                        // Main case where there are at least three hashtags at the end of the string
                        trim(preg_replace(
                            '/^(.+?)#\w+ (#\w+ )+#\w+$/m',
                            '${1}',
                            trim($caption)
                        ))
                    ))
                ))
            ));
    }

    /**
     * @param array $params
     * @return array
     */
    public function getSiteContentByHashTag(array $params)
    {
        $this->validator->setHashTagContentRules();

        if (!$this->validator->with($params)->passes()) {
            return [
                'html'   => "Getting pocket content by hash tags validation errors",
                'status' => 'validation-error',
                'error'  => $this->validator->errors()->messages()
            ];
        }

        $tags = explode(' ', trim($params['hash']));

        //remove white space from the array value
        $trimmedTags = array_unique(array_map(function ($item) {
            return $this->removeHashtags($item);
        }, $tags));

        return [
            "status" => 'success',
            'data'   => $this->tagRepo->getContentByTags($trimmedTags)
        ];
    }

    /**
     * @param array $params
     * @return array
     */
    public function deleteContentByUrl(array $params)
    {
        try {
            $this->validator->setDeleteContentRules();

            if (!$this->validator->with($params)->passes()) {
                return [
                    'html'   => "Delete Content by URL validation errors",
                    'status' => 'validation-error',
                    'error'  => $this->validator->errors()->messages()
                ];
            }

            return [
                "status" => 'success',
                'data'   =>  $this->pocketContentRepo->deleteContentByUrl($params['site_url'])
            ];
        } catch (DeleteContentException $e) {
            Log::error("Error occurred while deleting content.", [$e->getMessage()]);
            return [
                "status" => 'error',
                'html'   => "Something went wrong!!! while deleting content."
            ];
        }
    }
}
