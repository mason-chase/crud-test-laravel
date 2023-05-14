<?php

namespace Ddd\Infrastructure\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Ddd\Application\Customers\Handler\EditCustomerHandler;
use Ddd\Application\Customers\Queries\EditCustomerQuery;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use OpenApi\Annotations as OA;

class EditController extends Controller
{
    public function __construct(private EditCustomerHandler $customerHandler)
    {
    }

    /**
     * @OA\Get(
     *     path="/api/customers/{id}/edit",
     *     summary="Show customer edit form by ID",
     *     tags={"Customers"},
     *     @OA\Parameter(
     *         name="id",
     *         description="ID of the customer",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Customer edit form",
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Customer not found"
     *     )
     * )
     */
    public function edit(int $id): \Illuminate\Contracts\Foundation\Application|Factory|View|Application
    {
        $query = new EditCustomerQuery($id);
        $customer = $this->customerHandler->handle($query);
        return view('customers.edit', compact('customer'));
    }

}