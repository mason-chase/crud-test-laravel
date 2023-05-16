<?php

namespace App\Http\Controllers\Customers;

use App\Domains\Customer\Application\Commands\UpdateCustomerCommand;
use App\Domains\Customer\Application\Handler\UpdateCustomerHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerUpdateRequest;
use Illuminate\Http\JsonResponse;

class UpdateCustomerController extends Controller
{
    public function __construct(protected UpdateCustomerHandler $handler)
    {
    }

    /**
     * @OA\Put(
     *     path="/customers/{id}",
     *     summary="Update a customer",
     *     tags={"Customers"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Customer ID",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CustomerUpdateRequest")
     *     ),
     *     @OA\Response(
     *         response=202,
     *         description="Accepted",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found",
     *     ),
     * )
     */
    public function __invoke(int $id, CustomerUpdateRequest $request): JsonResponse
    {
        $query = new UpdateCustomerCommand(
            id: $id,
            firstName: $request->input('first_name'),
            lastName: $request->input('last_name'),
            email: $request->input('email'),
            bankAccountNumber: $request->input('bank_account_number'),
            phoneNumber: $request->input('phone_number'),
            dateOfBirth: $request->input('date_of_birth')
        );
        $this->handler->handle($query);

        return $this->accepted();
    }
}
