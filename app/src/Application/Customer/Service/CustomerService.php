<?php

namespace Ddd\Application\Customer\Service;

use Ddd\Application\Customer\Command\CreateCustomerCommand;
use Ddd\Application\Customer\Handler\CreateCustomerHandler;
use Ddd\Application\Customer\Requests\CreateCustomerRequest;
use Ddd\Domain\Customer\Customer;
use Ddd\Domain\Customer\CustomerRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use JetBrains\PhpStorm\NoReturn;

class CustomerService
{
//    private CustomerRepositoryInterface $customerRepository;
//
//    #[NoReturn] public function __construct(CustomerRepositoryInterface $customerRepository)
//    {
//        $this->customerRepository = $customerRepository;
//    }

    public function createCustomer(CreateCustomerRequest $request): JsonResponse
    {
        dd('asas');
        try {
            $customerData = $request->only([
                'first_name',
                'last_name',
                'email',
                'bank_account_number',
                'phone_number',
                'date_of_birth',
            ]);

            $command = new CreateCustomerCommand(
                $customerData['first_name'],
                $customerData['last_name'],
                $customerData['email'],
                $customerData['bank_account_number'],
                $customerData['phone_number'],
                $customerData['date_of_birth']
            );
            $handler = new CreateCustomerHandler($this->customerRepository);

            // Call the handle method on the handler with the command
            $handler->handle($command);

            $data = [
                'message' => 'Customer created successfully',
            ];

            return response()->json($data, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return \response()->json($e->getMessage());
        }

        $customer = new Customer($first_name, $last_name, $email, $bank_account_number, $phone_number, $date_of_birth);

        $this->customerRepository->save($customer);

        return $customer;
    }


    public function showCreateCustomer()
    {
        return view('customers.create');
    }

}
