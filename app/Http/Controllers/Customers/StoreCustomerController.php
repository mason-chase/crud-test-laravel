<?php

namespace App\Http\Controllers\Customers;

use App\Domains\Customer\Application\Commands\CreateCustomerCommand;
use App\Domains\Customer\Application\Handler\CreateCustomerHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\JsonResponse;

class StoreCustomerController extends Controller
{
    public function __construct(protected CreateCustomerHandler $handler)
    {
    }

    public function __invoke(CustomerStoreRequest $request): JsonResponse
    {
        $query = new CreateCustomerCommand(
            firstName: $request->input('first_name'),
            lastName: $request->input('last_name'),
            email: $request->input('email'),
            bankAccountNumber: $request->input('bank_account_number'),
            phoneNumber: $request->input('phone_number'),
            dateOfBirth: $request->input('date_of_birth')
        );

        return $this->created(CustomerResource::make($this->handler->handle($query)));
    }
}
