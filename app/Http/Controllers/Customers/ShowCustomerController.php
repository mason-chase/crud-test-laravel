<?php

namespace App\Http\Controllers\Customers;

use App\Domains\Customer\Application\Handler\ShowCustomerHandler;
use App\Domains\Customer\Application\Queries\ShowCustomerQuery;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\JsonResponse;

class ShowCustomerController extends Controller
{
    public function __construct(protected ShowCustomerHandler $handler)
    {
    }

    /**
     * @OA\Get(
     *     path="/customers/{id}",
     *     summary="Get a customer by ID",
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
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="data", ref="#/components/schemas/Customer"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found",
     *     ),
     * )
     */
    public function __invoke(int $id): JsonResponse
    {
        $query = new ShowCustomerQuery($id);
        return $this->ok(CustomerResource::make($this->handler->handle($query)));
    }
}
