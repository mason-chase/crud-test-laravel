<?php

namespace Tests\Application\Customer\Handler;

use Ddd\Application\Customers\Command\CreateCustomerCommand;
use Ddd\Application\Customers\Handler\CreateCustomerHandler;
use Ddd\Domain\Customers\CustomerRepositoryInterface;
use Ddd\Domain\Customers\Entities\CustomerModel;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery;
use Tests\TestCase;

class CreateCustomerHandlerTest extends TestCase
{
    use DatabaseTransactions;

    private CreateCustomerHandler $handler;
    private CustomerRepositoryInterface $repository;
    private array $customerData;

    public function setUp(): void
    {
        parent::setUp();

//        $this->withoutExceptionHandling();

        $this->repository = Mockery::mock(CustomerRepositoryInterface::class);
        $this->handler = new CreateCustomerHandler($this->repository);

        $this->customerData = [
            'first_name' => 'Majid',
            'last_name' => 'Kashefy',
            'email' => 'kashefymajid1992@gmail.com',
            'bank_account_number' => '####-####-####-####',
            'phone_number' => '+989135455305',
            'date_of_birth' => '1991-08-01',
        ];
    }

    public function testHandleMock(): void
    {
        $command = new CreateCustomerCommand(
            $this->customerData['first_name'],
            $this->customerData['last_name'],
            $this->customerData['email'],
            $this->customerData['bank_account_number'],
            $this->customerData['phone_number'],
            $this->customerData['date_of_birth']
        );

        // Create a mock for the CustomerRepository
//        $customerRepository = $this->createMock(CustomerRepositoryInterface::class);

        // Set up the mock to expect a call to save with a customer object
//        $this->repository->expects($this->once())
//            ->method('save')
//            ->with($this->isInstanceOf(Customer::class));

        $this->repository->shouldReceive('save')
            ->once()
            ->with(Mockery::on(function ($customer) {
                return $customer instanceof CustomerModel
                    && $customer['first_name'] === $this->customerData['first_name']
                    && $customer['last_name'] === $this->customerData['last_name']
                    && $customer['email'] === $this->customerData['email']
                    && $customer['bank_account_number'] === $this->customerData['bank_account_number']
                    && $customer['phone_number'] === $this->customerData['phone_number']
                    && $customer['date_of_birth'] === $this->customerData['date_of_birth'];
            }))
        ;

        // Call the handle method on the handler with the command
        $this->handler->handle($command);
    }

    public function testHandleWeb(): void
    {
        $data = [
            'first_name' => fake()->unique()->name(),
            'date_of_birth' => fake()->unique()->date(),
            'last_name' => fake()->unique()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'phone_number' => fake()->unique()->phoneNumber(),
            'bank_account_number' => fake()->numerify('####-####-####-####'),
        ];

        $response = $this->postJson(route('customers.create'), $data);
        dd($response);

        $this->repository->save($customer);

        $this->assertDatabaseHas('customers', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'phone' => '1234567890',
            'address' => '123 Main St, Anytown, USA',
        ]);
    }
}