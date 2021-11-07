<?php

namespace App\Http\Controllers;

use App\Contracts\PocketRepository;
use App\Contracts\Service\PocketContentServiceContract;
use App\Contracts\Service\PocketServiceContract;
use App\Validators\PocketValidator;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Http\Response;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SiteContentCreateRequest;
use App\Http\Requests\SiteContentUpdateRequest;
use App\Contracts\SiteContentRepository;
use App\Validators\SiteContentValidator;

/**
 * Class SiteContentsController.
 *
 * @package namespace App\Http\Controllers;
 */
class SiteContentsController extends BaseController
{
    /**
     * @var PocketRepository
     */
    protected $repository;

    /**
     * @var PocketValidator
     */
    protected $validator;
    /**
     * @var PocketServiceContract
     */
    private $pocketContentService;

    /**
     * PocketsController constructor.
     *
     * @param PocketContentServiceContract $pocketContentService
     */
    public function __construct(PocketContentServiceContract $pocketContentService)
    {
        $this->pocketContentService = $pocketContentService;
    }

    /**
     * @OA\Get(
     *      path="/pocket-site/{pocket_id}",
     *      operationId="Pocket content by pocket id",
     *      tags={"PocketContent"},
     *      summary="Get pocket content by pocket id",
     *      description="Get pocket content by pocket id",
     *      * @OA\RequestBody(
     *          required=true,
     *          description="Pass user credentials",
     *          @OA\JsonContent(
     *                  required={"pocket_id"},
     *                  @OA\Property(property="pocket_id", type="int", example="1 or 2 or any int"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Bad Request With Params"
     *      ), *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     * Display a listing of the Pockets.
     *
     * @param int $pocket_id
     * @return Response
     */
    public function index($pocket_id)
    {
        $data = $this->pocketContentService->getSiteContentByPocketId((int) $pocket_id);

        if (!empty($data['status']) && $data['status'] == 'success') {
            return $this->sendApiResponse("Success", $data['data']);
        }

        return $this->sendApiError($data['html']);
    }

    /**
     * @OA\Post(
     *      path="/pocket-site/create",
     *      operationId="Pocket content",
     *      tags={"PocketContent"},
     *      summary="Create pocket",
     *      description="Create pocket",
     *      * @OA\RequestBody(
     *          required=true,
     *          description="Pass user credentials",
     *          @OA\JsonContent(
     *                  required={"pocket_id","site_url"},
     *                  @OA\Property(property="pocket_id", type="int", example="1 or 2 or any int"),
     *                  @OA\Property(property="site_url", type="string", example="Any site url"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     *
     * Store a newly created pocket in storage.
     * @param  Request $request
     * @return Response
     */
    public function createPocketContent(Request $request)
    {
        $data = $this->pocketContentService->createPocketContent($request->all());

        if (!empty($data['status']) && $data['status'] == 'validation-error') {
            return $this->sendApiValidationError($data['error']);
        }

        if (!empty($data['status']) && $data['status'] == 'success') {
            return $this->sendApiResponse("Success", $data['data']);
        }

        return $this->sendApiError($data['html']);
    }


    /**
     * @OA\Post(
     *      path="/pocket/content",
     *      operationId="Pocket content by Hashtags",
     *      tags={"PocketContent"},
     *      summary="Get pocket content by Hashtags",
     *      description="Get pocket content by Hashtags",
     *      * @OA\RequestBody(
     *          required=true,
     *          description="Set hashtag for get content",
     *          @OA\JsonContent(
     *                  required={"hash"},
     *                  @OA\Property(property="hash", type="string", example="#anystring
     * with space for multiple hashtags like #media #cricket"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Bad Request With Params"
     *      ), *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     * Display a listing of the Pockets.
     *
     * @param string $hash_tag
     * @return Response
     */
    public function getByHashTags(Request $request)
    {
        $data = $this->pocketContentService->getSiteContentByHashTag($request->all());

        if (!empty($data['status']) && $data['status'] == 'validation-error') {
            return $this->sendApiValidationError($data['error']);
        }

        if (!empty($data['status']) && $data['status'] == 'success') {
            return $this->sendApiResponse("Success", $data['data']);
        }

        return $this->sendApiError($data['html']);
    }



    /**
     * @OA\Post(
     *      path="/pocket/content/delete",
     *      operationId="Pocket content delete by url",
     *      tags={"PocketContent"},
     *      summary="Delete pocket content by URL",
     *      description="Delete pocket content by URL",
     *      * @OA\RequestBody(
     *          required=true,
     *          description="Delete pocket content by URL",
     *          @OA\JsonContent(
     *                  required={"site_url"},
     *                  @OA\Property(property="site_url", type="string", example="Any site url"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Bad Request With Params"
     *      ), *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     * Display a listing of the Pockets.
     *
     * @param string $hash_tag
     * @return Response
     */
    public function deleteContentByUrl(Request $request)
    {
        $data = $this->pocketContentService->deleteContentByUrl($request->all());

        if (!empty($data['status']) && $data['status'] == 'validation-error') {
            return $this->sendApiValidationError($data['error']);
        }

        if (!empty($data['status']) && $data['status'] == 'success') {
            return $this->sendApiResponse("Success", $data['data']);
        }

        return $this->sendApiError($data['html']);
    }
}
