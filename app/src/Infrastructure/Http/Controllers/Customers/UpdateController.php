<?php

namespace Ddd\Infrastructure\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Ddd\Application\Customers\Command\UpdateCustomerCommand;
use Ddd\Application\Customers\Handler\UpdateCustomerHandler;
use Ddd\Application\Customers\Requests\UpdateCustomerRequest;
use Ddd\Domain\Customers\Entities\CustomerModel;
use Illuminate\Support\Facades\Redirect;
use OpenApi\Annotations as OA;

class UpdateController extends Controller
{
    public function __construct(private UpdateCustomerHandler $updateCustomerHandler)
    {
    }

    /**
     * @OA\Put(
     *     path="/api/customers/{id}",
     *     summary="Update customer by ID",
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
     *     @OA\RequestBody(
     *         description="Customer object",
     *         required=true,
     *     ),
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
    public function update(UpdateCustomerRequest $request, int $id): \Illuminate\Http\RedirectResponse
    {
        try {
            $customer= CustomerModel::whereId($id)->get();
            $command = new UpdateCustomerCommand(
                $id,
                $request->first_name ?? $customer->first_name,
                $request->last_name ?? $customer->last_name,
                $request->email ?? $customer->email,
                $request->bank_account_number ?? $customer->bank_account_number,
                $request->phone_number ?? $customer->phone_number,
                $request->date_of_birth ?? $customer->date_of_birth
            );
            $this->updateCustomerHandler->handle($command);

            return redirect()->route('customers.update', $id)
                ->with('success', __('The customer has been updated.'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

}