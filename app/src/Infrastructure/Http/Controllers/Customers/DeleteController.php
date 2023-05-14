<?php

namespace Ddd\Infrastructure\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Ddd\Application\Customers\Command\DeleteCustomerCommand;
use Ddd\Application\Customers\Handler\DeleteCustomerHandler;
use OpenApi\Annotations as OA;

class DeleteController extends Controller
{
    public function __construct(private DeleteCustomerHandler $deleteCustomerHandler)
    {
    }

    /**
     * @OA\Delete(
     *     path="/api/customers/{id}",
     *     summary="Delete customer by ID",
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
     *         response="204",
     *         description="Customer deleted successfully"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Customer not found"
     *     )
     * )
     */
    public function destroy(int $id): \Illuminate\Http\RedirectResponse
    {
        try {
            $command = new DeleteCustomerCommand($id);
            $this->deleteCustomerHandler->handle($command);

            return redirect()->route('customers.index')
                ->with('success', __('The customer has been removed.'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

}