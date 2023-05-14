<?php

namespace Ddd\Infrastructure\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Ddd\Application\Customers\Command\CreateCustomerCommand;
use Ddd\Application\Customers\Handler\CreateCustomerHandler;
use Ddd\Application\Customers\Requests\CreateCustomerRequest;
use Illuminate\Http\RedirectResponse;
use OpenApi\Annotations as OA;

class StoreController extends Controller
{

    public function __construct(private CreateCustomerHandler $createCustomerHandler)
    {
    }

    /**
     * @OA\Post(
     *     path="/api/customers",
     *     summary="Create a new customer",
     *     tags={"Customers"},
     *     @OA\RequestBody(
     *         description="Customer object",
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="first_name", type="string"),
     *             @OA\Property(property="last_name", type="string"),
     *             @OA\Property(property="date_of_birth", type="string", format="date"),
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="phone_number", type="string"),
     *             @OA\Property(property="bank_account_number", type="string")
     *         )
     *     ),
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
    /**
     * @param CreateCustomerRequest $request
     * @return RedirectResponse
     */
    public function store(CreateCustomerRequest $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $command = new CreateCustomerCommand(
                $request->first_name,
                $request->last_name,
                $request->email,
                $request->bank_account_number,
                $request->phone_number,
                $request->date_of_birth
            );
            $this->createCustomerHandler->handle($command);

            return redirect()->route('customers.index')
                ->with('success', __('The customer has been created.'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

}