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
