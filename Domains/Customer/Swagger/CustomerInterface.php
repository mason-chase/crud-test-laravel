<?php

namespace Domains\Customer\Swagger;

use Domains\Customer\Http\Requests\DeleteCustomerRequest;
use Domains\Customer\Http\Requests\StoreCustomerRequest;
use Domains\Customer\Http\Requests\UpdateCustomerRequest;

interface CustomerInterface
{
    /**
     * @OA\Get(
     *     path="/api/customers",
     *     summary="Get a list of customers",
     *     tags={"Customers"},
     *
     *     @OA\Response(
     *         response="200",
     *         description="List of customers",
     *
     *         @OA\JsonContent(
     *             type="objext",
     *         )
     *     )
     * )
     */
    public function index();

    /**
     * @OA\Get(
     *     path="/api/customers/{id}",
     *     summary="Get customer by id",
     *     tags={"Customers"},
     *
     *     @OA\Parameter(
     *         name="id",
     *         description="id of the customer",
     *         required=true,
     *         in="path",
     *
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *
     *     @OA\RequestBody(
     *         description="Customer object",
     *         required=true,
     *     ),
     *
     *     @OA\Response(
     *         response="200",
     *         description="Customer updated successfully",
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Invalid request body"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Customer not found"
     *     )
     * )
     */
    public function show($id);

    /**
     * @OA\Post(
     *     path="/api/customers",
     *     summary="Create a customer",
     *     tags={"Customers"},
     *
     *     @OA\RequestBody(
     *         description="Customer object",
     *         required=true,
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="first_name", type="string"),
     *             @OA\Property(property="last_name", type="string"),
     *             @OA\Property(property="date_of_birth", type="string", format="date"),
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="phone_number", type="string"),
     *             @OA\Property(property="bank_account_number", type="string")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="201",
     *         description="Customer created successfully",
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Invalid request body"
     *     )
     * )
     */
    public function store(StoreCustomerRequest $request);

    /**
     * @OA\Put(
     *     path="/api/customers/{id}",
     *     summary="Update customer by id",
     *     tags={"Customers"},
     *
     *     @OA\Parameter(
     *         name="id",
     *         description="id of the customer",
     *         required=true,
     *         in="path",
     *
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *
     *     @OA\RequestBody(
     *         description="Customer object",
     *         required=true,
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="first_name", type="string"),
     *             @OA\Property(property="last_name", type="string"),
     *             @OA\Property(property="date_of_birth", type="string", format="date"),
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="phone_number", type="string"),
     *             @OA\Property(property="bank_account_number", type="string")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="200",
     *         description="Customer updated successfully",
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Invalid request body"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Customer not found"
     *     )
     * )
     */
    public function update(UpdateCustomerRequest $request, $id);

    /**
     * @OA\Delete(
     *     path="/api/customers/{id}",
     *     summary="Delete customer by id",
     *     tags={"Customers"},
     *
     *     @OA\Parameter(
     *         name="id",
     *         required=true,
     *         in="path",
     *
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="204",
     *         description="Customer deleted successfully"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Customer not found"
     *     )
     * )
     */
    public function destroy(DeleteCustomerRequest $request, $id);
}
