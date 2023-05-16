<?php

namespace App\Http\Controllers\Customers;

use App\Domains\Customer\Application\Commands\DeleteCustomerCommand;
use App\Domains\Customer\Application\Handler\DeleteCustomerHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;


class DeleteCustomerController extends Controller
{
    public function __construct(protected DeleteCustomerHandler $handler)
    {
    }

    /**
     * @OA\Delete(
     *     path="/customers/{id}",
     *     summary="Delete a customer",
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
    public function __invoke(int $id): JsonResponse
    {
        $query = new DeleteCustomerCommand(id: $id);
        $this->handler->handle($query);

        return $this->accepted();
    }
}
