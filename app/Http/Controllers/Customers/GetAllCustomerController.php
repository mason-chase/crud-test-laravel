<?php

namespace App\Http\Controllers\Customers;

use App\Domains\Customer\Application\Handler\GetAllCustomerHandler;
use App\Domains\Customer\Application\Queries\GetAllCustomerQuery;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\JsonResponse;

class GetAllCustomerController extends Controller
{
    public function __construct(protected GetAllCustomerHandler $handler)
    {
    }

    /**
     * @OA\Get(
     *     path="/customers",
     *     summary="Get all customers",
     *     tags={"Customers"},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Customer")
     *         )
     *     ),
     * )
     */
    public function __invoke(): JsonResponse
    {
        $query = new GetAllCustomerQuery();
        return $this->ok(CustomerResource::collection($this->handler->handle($query)));
    }
}
