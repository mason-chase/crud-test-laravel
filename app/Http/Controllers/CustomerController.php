<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CustomerController extends Controller
{
    /**
     * @return JsonResponse
     *
     * @OA\Get(
     * path="/api/customers",
     * operationId="index",
     * tags={"Customer"},
     * summary="Get all customers",
     * description="Customers List here",
     *      @OA\Response(
     *          response=200,
     *          description="Get Customers List Successfully",
     *          @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Customer")
     *         ),
     *       ),
     * )
     */
    public function index(): JsonResponse
    {
        return success_response(CustomerResource::collection(Customer::all())); //TODO:: Must be get data as pagination
    }

    /**
     * @param Customer $customer
     * @return JsonResponse
     *
     * @OA\Get (
     * path="/api/customers/{customer}",
     * operationId="show",
     * tags={"Customer"},
     * summary="Get one customer by ID",
     * description="Customer Get here",
     *     @OA\Parameter(
     *          description="ID of Customer",
     *          in="path",
     *          name="customer",
     *          required=true,
     *          example="1",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Get Customer Successfully",
     *          @OA\JsonContent(ref="#/components/schemas/Customer"),
     *       ),
     *      @OA\Response(response=404,
     *          description="Not found model",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorResponse"),
     *      ),
     * )
     */
    public function show(Customer $customer): JsonResponse
    {
        return success_response(new CustomerResource($customer));
    }

    /**
     * @param CustomerRequest $request
     * @return JsonResponse
     *
     * @OA\Post(
     * path="/api/customers",
     * operationId="store",
     * tags={"Customer"},
     * summary="Customer Create",
     * description="Customer Create here",
     *     @OA\RequestBody( @OA\JsonContent(ref="#/components/schemas/Customer")),
     *      @OA\Response(
     *          response=200,
     *          description="Create Customer Successfully",
     *          @OA\JsonContent(ref="#/components/schemas/Customer"),
     *       ),
     *      @OA\Response(
     *          response=302,
     *          description="Exist Customer",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorResponse"),
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad request",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorResponse"),
     *      ),
     * )
     */
    public function store(CustomerRequest $request): JsonResponse
    {
        /** @var Customer $exist */
        $exist = Customer::query()
            ->where('first_name', $request->get('first_name'))
            ->where('last_name', $request->get('last_name'))
            ->where('date_of_birth', $request->get('date_of_birth'))
            ->first();

        if (!is_null($exist)) {
            return error_response(null, 'messages.exist_customer', ResponseAlias::HTTP_FOUND);
        }

        /** @var Customer $customer */
        $customer = Customer::query()->create($request->all());

        return success_response(new CustomerResource($customer));
    }

    /**
     * @param CustomerRequest $request
     * @param Customer $customer
     * @return JsonResponse
     *
     * @OA\Put(
     * path="/api/customers/{customer}",
     * operationId="update",
     * tags={"Customer"},
     * summary="Customer Update",
     * description="Customer Edit here",
     *     @OA\Parameter(
     *          description="ID of Customer",
     *          in="path",
     *          name="customer",
     *          required=true,
     *          example="1",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *     @OA\RequestBody( @OA\JsonContent(ref="#/components/schemas/Customer")),
     *      @OA\Response(
     *          response=200,
     *          description="Update Customer Successfully",
     *          @OA\JsonContent(ref="#/components/schemas/Customer"),
     *       ),
     *      @OA\Response(
     *          response=302,
     *          description="Exist Customer",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorResponse"),
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Not found model",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorResponse"),
     *      ),
     *     @OA\Response(
     *          response=400,
     *          description="Bad request",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorResponse"),
     *      ),
     * )
     */
    public function update(CustomerRequest $request, Customer $customer): JsonResponse
    {
        /** @var Customer $exist */
        $exist = Customer::query()
            ->where('first_name', $request->get('first_name'))
            ->where('last_name', $request->get('last_name'))
            ->where('date_of_birth', $request->get('date_of_birth'))
            ->where('id', '!=', $customer->id)
            ->first();

        if (!is_null($exist)) {
            return error_response(null, 'messages.exist_customer', ResponseAlias::HTTP_FOUND);
        }

        $customer->update($request->all());

        return success_response(new CustomerResource($customer));
    }

    /**
     * @param Customer $customer
     * @return JsonResponse
     *
     * @OA\Delete(
     * path="/api/customers/{customer}",
     * operationId="destroy",
     * tags={"Customer"},
     * summary="Customer Delete",
     * description="Customer Delete here",
     *     @OA\Parameter(
     *          description="ID of Customer",
     *          in="path",
     *          name="customer",
     *          required=true,
     *          example="1",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Delete Customer Successfully",
     *          @OA\JsonContent(ref="#/components/schemas/Customer"),
     *       ),
     *      @OA\Response(response=404,
     *          description="Not found model",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorResponse"),
     *      ),
     * )
     */
    public function destroy(Customer $customer): JsonResponse
    {
        $customer->delete();

        return success_response(new CustomerResource($customer));
    }

}
