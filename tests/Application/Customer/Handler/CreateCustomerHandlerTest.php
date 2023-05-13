<?php

namespace Tests\Application\Customer\Handler;

use App\Models\User;
use Ddd\Application\Customers\Command\CreateCustomerCommand;
use Ddd\Application\Customers\Handler\CreateCustomerHandler;
use Ddd\Domain\Customers\CustomerRepositoryInterface;
use Ddd\Domain\Customers\Entities\CustomerModel;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Response;
use Mockery;
use Tests\TestCase;

class CreateCustomerHandlerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    private CreateCustomerHandler $handler;
    private CustomerRepositoryInterface $repository;
    private array $customerData;
    private array $fakeData;

    public function setUp(): void
    {
        parent::setUp();

//        $this->withoutExceptionHandling();

        $this->repository = Mockery::mock(CustomerRepositoryInterface::class);
        $this->handler = new CreateCustomerHandler($this->repository);

        // Sample data for mock method
        $this->customerData = [
            'first_name' => 'Majid',
            'last_name' => 'Kashefy',
            'email' => 'kashefymajid1992@gmail.com',
            'bank_account_number' => '####-####-####-####',
            'phone_number' => '+989135455305',
            'date_of_birth' => '1991-08-01',
        ];

        // Sample data for entry request
        $this->fakeData = [
            'first_name' => fake()->unique()->name(),
            'date_of_birth' => fake()->unique()->date(),
            'last_name' => fake()->unique()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'phone_number' => fake()->unique()->phoneNumber(),
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
        $command = new CreateCustomerCommand(
            $this->customerData['first_name'],
            $this->customerData['last_name'],
            $this->customerData['email'],
            $this->customerData['bank_account_number'],
            $this->customerData['phone_number'],
            $this->customerData['date_of_birth']
        );

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
            }));

        // Call the handle method on the handler with the command
        $this->handler->handle($command);
    }

    public function test_it_can_create_a_customer()
    {
        $this->loginUser();
        $entryArrayData = $this->fakeData;
        $response = $this->post(route('customers.store'), $entryArrayData + ['_token' => csrf_token()]);
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('customers.create.show'));
        $this->assertDatabaseHas('customers', $entryArrayData);
    }

    public function test_it_cannot_create_a_customer_with_invalid_data()
    {
        $this->loginUser();
        $response = $this->post(route('customers.store'), []);
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors(['first_name', 'last_name', 'email', 'bank_account_number', 'phone_number', 'date_of_birth']);
        $this->assertDatabaseCount('customers', 0);
    }

    public function test_it_cannot_create_a_customer_with_duplicate_email()
    {
        $this->loginUser();
        $customer = CustomerModel::factory()->create();

        $response = $this->post(route('customers.store'), [
            'first_name' => fake()->unique()->name(),
            'date_of_birth' => fake()->unique()->date(),
            'last_name' => fake()->unique()->lastName(),
            'phone_number' => fake()->unique()->phoneNumber(),
            'bank_account_number' => fake()->numerify('####-####-####-####'),
            'email' => $customer->email,
        ]);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors(['email']);
        $this->assertDatabaseCount('customers', 1);
    }
}