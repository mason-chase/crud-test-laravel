<?php

namespace Test\CustomerManager\App\Http\Controllers\Api;

use Test\BaceManager\App\Helper\ApiController;
use Test\CustomerManager\App\Http\Requests\CustomerDeleteRequest;
use Test\CustomerManager\App\Http\Requests\CustomerIndexRequest;
use Test\CustomerManager\App\Http\Requests\CustomerStoreRequest;
use Test\CustomerManager\App\Http\Requests\CustomerUpdateRequest;
use Test\CustomerManager\App\Http\Resources\CustomerCollection;
use Test\CustomerManager\App\Http\Resources\CustomerResource;
use Test\CustomerManager\Models\Customer;
use Test\CustomerManager\Models\Repositories\CustomerRepository;

class CustomerApiController extends ApiController
{
   
    public function __construct(
        private CustomerRepository $customerRepo){}

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
     *     @OA\Response(
     *        response=422,
     *        description="Unprocessable Entity"
     *    )
     *)
     **/
    public function index(CustomerIndexRequest $request)
    {
        return $this->successResponse(
            new CustomerCollection(
                $this->customerRepo->get($request->all())
            )
        );
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
     *              @OA\Property(property="bank_account_number", type="int"),
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
    public function store(CustomerStoreRequest $request)
    {
        return $this->successResponse(
            CustomerResource::make(
                $this->customerRepo->create($request->all())
            )
        );
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
    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        return $this->successResponse(
            CustomerResource::make(
                $this->customerRepo->update($customer->id, $request->all())
            )
        );
    }

    /**
     * @OA\Delete(
     ** path="/api/v1/customer",
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
     *  @OA\RequestBody(
     *      required = true,
     *      description = "Customer ids ",
     *          @OA\JsonContent(
     *              type="object",
     *                 @OA\Property(
     *                    type="array",
     *                    property="ids",
     *                          @OA\Items(
     *                              type="array",
     *                              type="int"
     *                           )
     *              )
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
    public function destroy(CustomerDeleteRequest $request)
    {
        $this->customerRepo->multydelete($request->ids);

        return $this->successResponse([], '');
    }
}
