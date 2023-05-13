<?php

namespace Tests\Application\Customer\Handler;

use App\Models\User;
use Ddd\Application\Customers\Command\UpdateCustomerCommand;
use Ddd\Application\Customers\Handler\UpdateCustomerHandler;
use Ddd\Domain\Customers\CustomerRepositoryInterface;
use Ddd\Domain\Customers\Entities\CustomerModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Response;
use Mockery;
use Tests\TestCase;

class UpdateCustomerHandlerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    private UpdateCustomerHandler $handler;
    private CustomerRepositoryInterface $repository;
    private array $requestData;
    private array $fakeData;

    public function setUp(): void
    {
        parent::setUp();

//        $this->withoutExceptionHandling();

        // Mock the dependencies
        $this->repository = Mockery::mock(CustomerRepositoryInterface::class);
        $this->handler = new UpdateCustomerHandler($this->repository);

        // Define the expected inputs and outputs
        $this->requestData = [
            'first_name' => 'Majid',
            'last_name' => 'Kashefy',
            'email' => 'kashefymajid1992@gmail.com',
            'bank_account_number' => '3454-4444-4565-6778',
            'phone_number' => '+989135455305',
            'date_of_birth' => '1991-08-01',
        ];

        // Sample data for entry request
        $this->fakeData = [
            'first_name' => fake()->unique()->name(),
            'date_of_birth' => fake()->unique()->date(),
            'last_name' => fake()->unique()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'phone_number' => '+989135455305',
            'bank_account_number' => fake()->numerify('####-####-####-####'),
        ];
    }

    public function loginUser()
    {
        $user = User::query()->first();
        if (is_null($user) || !$user->exists()) {
            $user = User::factory()->create();

        }
        $this->actingAs($user);

    }

    public function test_handle_mock(): void
    {
        $customer = CustomerModel::factory()->create();

        $command = new UpdateCustomerCommand(
            $customer->id,
            $this->requestData['first_name'],
            $this->requestData['last_name'],
            $this->requestData['email'],
            $this->requestData['bank_account_number'],
            $this->requestData['phone_number'],
            $this->requestData['date_of_birth']
        );

        // Set up the expectations
        $this->repository->shouldReceive('update')->once()->with($customer->id, $this->requestData)->andReturn($customer);

        // Call the handle method on the handler with the command
        $this->handler->handle($command);
    }

    public function test_it_can_update_a_customer()
    {
        $this->loginUser();
        $customer = CustomerModel::factory()->create();

        $response = $this->put(route('customers.update', $customer->id), $this->requestData);
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('customers.update', $customer->id));
        $this->assertDatabaseHas('customers', $this->requestData);
    }

    public function test_it_cannot_update_a_customer_with_invalid_data()
    {
        $this->loginUser();
        $customer = CustomerModel::factory()->create();
        $response = $this->put(route('customers.update', $customer->id), []);
        $response->assertStatus(Response::HTTP_FOUND);
    }


}