<?php

namespace Customer\Handler;

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

class GetAllCustomerHandlerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    private CreateCustomerHandler $handler;
    private CustomerRepositoryInterface $repository;
    private array $customerData;
    private array $fakeData;

    public function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();

        $this->repository = $this->createMock(CustomerRepositoryInterface::class);
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
        $this->fakeData2 = [
            'first_name' => fake()->unique()->name(),
            'date_of_birth' => fake()->unique()->date(),
            'last_name' => fake()->unique()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'phone_number' => fake()->unique()->phoneNumber(),
            'bank_account_number' => fake()->numerify('####-####-####-####'),
        ];
        $this->fakeData3 = [
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
        // create some mock customers
        $customer1 = CustomerModel::factory()->create($this->fakeData);
        $customer2 = CustomerModel::factory()->create($this->fakeData2);
        $customer3 = CustomerModel::factory()->create($this->fakeData3);


        $this->repository
            ->expects($this->once())
            ->method('getAll')
            ->willReturn([$customer1, $customer2, $customer3]);

        // inject the mock repository into the controller
        $this->app->instance(CustomerRepositoryInterface::class, $this->repository);

        // send a GET request to the customers index page
        $response = $this->get(route('customers.index'));
        $response->assertStatus(Response::HTTP_OK)
            ->assertSee($customer1->email)
            ->assertSee($customer2->email)
            ->assertSee($customer3->email);
    }

    public function test_it_can_display_a_list_of_customers()
    {

        $customer1 = CustomerModel::factory()->create($this->fakeData);
        $customer2 = CustomerModel::factory()->create($this->fakeData2);
        $customer3 = CustomerModel::factory()->create($this->fakeData3);

        // send a GET request to the customers index page
        $response = $this->get(route('customers.index'));

        // assert that the response contains the expected customers
        $response->assertStatus(Response::HTTP_OK)
            ->assertSee($customer1->first_name)
            ->assertSee($customer2->first_name)
            ->assertSee($customer3->first_name);
    }

}