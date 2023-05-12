<?php

namespace Domains\Customer\Http\Controllers\Api;

use App\Utility\ApiResponse;
use Domains\Customer\Http\Requests\UpdateCustomerRequest;
use Domains\Customer\Http\Requests\StoreCustomerRequest;
use Domains\Customer\Services\CustomerService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

class CustomerController extends Controller
{
    protected CustomerService $service;

    public function __construct(CustomerService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     ** path="/api/v1/customer",
     *   tags={"Customer"},
     *   summary="show customers list",
     *   operationId="show customers",
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *    @OA\Response(
     *        response=403,
     *        description="Forbidden"
     *    ),
     *     @OA\Response(
     *        response=422,
     *        description="Unprocessable Entity"
     *    )
     *)
     **/
    public function index(): JsonResponse
    {
        $customers = $this->service->index();

        return ApiResponse::success('list of customer!', $customers);

    }

    /**
     * @OA\Get(
     * path="/api/v1/customer/{customer}",
     *   tags={"Customer"},
     *   summary="show customer by id",
     *   operationId="show customer by id",
     *
     *  @OA\Parameter(
     *      name="customer",
     *      in="path",
     *      description="customer",
     *      required=true,
     *  ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *    @OA\Response(
     *        response=403,
     *        description="Forbidden"
     *    ),
     *     @OA\Response(
     *        response=422,
     *        description="Unprocessable Entity"
     *    )
     *)
     **/
    public function show($id): JsonResponse
    {
        $customer = $this->service->show($id);

        return ApiResponse::success('customer detail!', $customer);
    }

    /**
     * @OA\Post(
     ** path="/api/v1/customer",
     *   tags={"Customer"},
     *   summary="store customer",
     *   operationId="store customer",
     *
     *  @OA\RequestBody(
     *      required = true,
     *      description = "Customer Data",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="first_name", type="string"),
     *              @OA\Property(property="last_name", type="string"),
     *              @OA\Property(property="date_of_birth", type="string"),
     *              @OA\Property(property="phone_number", type="string"),
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="bank_account_number", type="string"),
     *          ),
     *  ),
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *    @OA\Response(
     *        response=403,
     *        description="Forbidden"
     *    ),
     *     @OA\Response(
     *        response=422,
     *        description="Unprocessable Entity"
     *    )
     *)
     **/
    public function store(StoreCustomerRequest $request): JsonResponse
    {
        $customer = $this->service->store($request);

        return ApiResponse::success('customer stored successfully!', $customer);
    }

    /**
     * @OA\Put(
     ** path="/api/v1/customer/{customer}",
     *   tags={"Customer"},
     *   summary="update customer",
     *   operationId=" update customer",
     *
     *  @OA\Parameter(
     *      name="customer",
     *      in="path",
     *      description="customer",
     *      required=true,
     *  ),
     *
     *  @OA\RequestBody(
     *      required = true,
     *      description = "Customer Data",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="first_name", type="string"),
     *              @OA\Property(property="last_name", type="string"),
     *              @OA\Property(property="date_of_birth", type="string"),
     *              @OA\Property(property="phone_number", type="string"),
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="bank_account_number", type="string"),
     *          ),
     *  ),
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *    @OA\Response(
     *        response=403,
     *        description="Forbidden"
     *    ),
     *     @OA\Response(
     *        response=422,
     *        description="Unprocessable Entity"
     *    )
     *)
     **/
    public function update(UpdateCustomerRequest $request, $id): JsonResponse
    {
        return $this->service->update($request, $id);
    }

    /**
     * @OA\Delete(
     ** path="/api/v1/customer/{customer}",
     *   tags={"Customer"},
     *   summary="delete customer",
     *   operationId="delete customer",
     *
     *  @OA\Parameter(
     *      name="customer",
     *      in="path",
     *      description="customer",
     *      required=true,
     *  ),
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *    @OA\Response(
     *        response=403,
     *        description="Forbidden"
     *    ),
     *     @OA\Response(
     *        response=422,
     *        description="Unprocessable Entity"
     *    )
     *)
     **/
    public function destroy($id): JsonResponse
    {
        $customer = $this->service->destroy($id);

        return ApiResponse::success('customer deleted successfully!');
    }
}
