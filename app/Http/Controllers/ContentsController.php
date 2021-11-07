<?php

namespace App\Http\Controllers;

use App\Contracts\Service\PocketContentServiceContract;
use App\Contracts\Service\PocketServiceContract;
use Illuminate\Http\Response;

/**
 * Class ContentsController.
 *
 * @package namespace App\Http\Controllers;
 */
class ContentsController extends Controller
{
    /**
     * @var PocketServiceContract
     */
    private $pocketService;
    /**
     * @var PocketContentServiceContract
     */
    private $pocketContentService;

    /**
     * ContentsController constructor.
     *
     * @param PocketServiceContract $pocketService
     * @param PocketContentServiceContract $pocketContent
     */
    public function __construct(
        PocketServiceContract $pocketService,
        PocketContentServiceContract $pocketContent
    ) {
        $this->pocketService = $pocketService;
        $this->pocketContentService = $pocketContent;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $contents = $this->pocketService->getPocketList();

        if (request()->wantsJson()) {
            return response()->json($contents);
        }

        return view('pocket', compact('contents'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param $pocketId
     * @return Response
     */
    public function pocketDetalis($pocketId)
    {
        $contents = $this->pocketContentService->getSiteContentByPocketId($pocketId);

        if (request()->wantsJson()) {
            return response()->json($contents);
        }

        return view('pocket-details', compact('contents'));
    }
}
