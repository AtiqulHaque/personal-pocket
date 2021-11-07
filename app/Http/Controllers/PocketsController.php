<?php

namespace App\Http\Controllers;

use App\Contracts\Service\BookingServiceContract;
use App\Contracts\Service\NewServiceContract;
use App\Contracts\Service\PocketServiceContract;
use App\Contracts\Service\UserServiceContract;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Http\Response;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PocketCreateRequest;
use App\Http\Requests\PocketUpdateRequest;
use App\Contracts\PocketRepository;
use App\Validators\PocketValidator;

/**
 * Class PocketsController.
 *
 * @package namespace App\Http\Controllers;
 */
class PocketsController extends BaseController
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
    private $pocketService;

    /**
     * PocketsController constructor.
     *
     * @param PocketServiceContract $pocketService
     */
    public function __construct(PocketServiceContract $pocketService)
    {
        $this->pocketService = $pocketService;
    }

    /**
     * @OA\Get(
     *      path="/pocket",
     *      operationId="Gett Pocket listing",
     *      tags={"Pocket"},
     *      summary="Get pocket all pocket listing",
     *      description="Get pocket all pocket listing",
     *      * @OA\RequestBody(
     *          description="Pass page nubmer",
     *          @OA\JsonContent(
     *                  @OA\Property(property="page", type="int", example="1 or 2 or any int"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Bad Request With Params"
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
     * Display a listing of the Pockets.
     *
     * @return Response
     */
    public function index()
    {
        $data = $this->pocketService->getPocketList();

        if (!empty($data['status']) && $data['status'] == 'success') {
            return $this->sendApiResponse("Success", $data['data']);
        }

        return $this->sendApiError($data['html']);
    }

    /**
     * @OA\Post(
     *      path="/pocket/create",
     *      operationId="Pocket content",
     *      tags={"Pocket"},
     *      summary="Create pocket",
     *      description="Create pocket",
     *      * @OA\RequestBody(
     *          required=true,
     *          description="Pass user credentials",
     *          @OA\JsonContent(
     *                  required={"title"},
     *                  @OA\Property(property="title", type="string", example="Create pocket with a name"),
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
    //     */
    public function createPocket(Request $request)
    {
        $data = $this->pocketService->createPocket($request->get('title'));

        if (!empty($data['status']) && $data['status'] == 'validation-error') {
            return $this->sendApiValidationError($data['error']);
        }

        if (!empty($data['status']) && $data['status'] == 'success') {
            return $this->sendApiResponse("Success", $data['data']);
        }

        return $this->sendApiError($data['html']);
    }

//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  PocketCreateRequest $request
//     *
//     * @return Response
//     *
//     * @throws \Prettus\Validator\Exceptions\ValidatorException
//     */
//    public function store(PocketCreateRequest $request)
//    {
//        try {
//
//            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
//
//            $pocket = $this->repository->create($request->all());
//
//            $response = [
//                'message' => 'Pocket created.',
//                'data'    => $pocket->toArray(),
//            ];
//
//            if ($request->wantsJson()) {
//
//                return response()->json($response);
//            }
//
//            return redirect()->back()->with('message', $response['message']);
//        } catch (ValidatorException $e) {
//            if ($request->wantsJson()) {
//                return response()->json([
//                    'error'   => true,
//                    'message' => $e->getMessageBag()
//                ]);
//            }
//
//            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
//        }
//    }
//
//    /**
//     * Display the specified resource.
//     *
//     * @param  int $id
//     *
//     * @return Response
//     */
//    public function show($id)
//    {
//        $pocket = $this->repository->find($id);
//
//        if (request()->wantsJson()) {
//
//            return response()->json([
//                'data' => $pocket,
//            ]);
//        }
//
//        return view('pockets.show', compact('pocket'));
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  int $id
//     *
//     * @return Response
//     */
//    public function edit($id)
//    {
//        $pocket = $this->repository->find($id);
//
//        return view('pockets.edit', compact('pocket'));
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  PocketUpdateRequest $request
//     * @param  string            $id
//     *
//     * @return Response
//     *
//     * @throws \Prettus\Validator\Exceptions\ValidatorException
//     */
//    public function update(PocketUpdateRequest $request, $id)
//    {
//        try {
//
//            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
//
//            $pocket = $this->repository->update($request->all(), $id);
//
//            $response = [
//                'message' => 'Pocket updated.',
//                'data'    => $pocket->toArray(),
//            ];
//
//            if ($request->wantsJson()) {
//
//                return response()->json($response);
//            }
//
//            return redirect()->back()->with('message', $response['message']);
//        } catch (ValidatorException $e) {
//
//            if ($request->wantsJson()) {
//
//                return response()->json([
//                    'error'   => true,
//                    'message' => $e->getMessageBag()
//                ]);
//            }
//
//            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
//        }
//    }
//
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  int $id
//     *
//     * @return Response
//     */
//    public function destroy($id)
//    {
//        $deleted = $this->repository->delete($id);
//
//        if (request()->wantsJson()) {
//
//            return response()->json([
//                'message' => 'Pocket deleted.',
//                'deleted' => $deleted,
//            ]);
//        }
//
//        return redirect()->back()->with('message', 'Pocket deleted.');
//    }
}
