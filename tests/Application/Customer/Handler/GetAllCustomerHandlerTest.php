<?php

namespace Tests\Application\Customer\Handler;

use App\Models\User;
use Ddd\Application\Customers\Handler\GetAllCustomerHandler;
use Ddd\Application\Customers\Queries\GetAllCustomerQuery;
use Ddd\Domain\Customers\CustomerRepositoryInterface;
use Ddd\Domain\Customers\Entities\CustomerModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Response;
use Mockery;
use Tests\TestCase;

class GetAllCustomerHandlerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    private GetAllCustomerHandler $handler;
    private CustomerRepositoryInterface $repository;
    private array $customerData;
    private array $fakeData;
    private $getAllCustomerHandler;
    public function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();

        $this->repository = Mockery::mock(CustomerRepositoryInterface::class);
        $this->handler = new GetAllCustomerHandler($this->repository);

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
        $this->loginUser();

        $query = new GetAllCustomerQuery('first_name','asc');

        $this->repository->shouldReceive('getAll')
            ->with('first_name', 'asc')
            ->once();

        // Call the handle method on the handler with the command
        $this->handler->handle($query);

    }

    public function test_it_can_display_a_list_of_customers()
    {
        $this->loginUser();
        CustomerModel::factory(3)->create();
        $response = $this->get(route('customers.index'));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewHas('customers');
        $customers = $response->original->getData()['customers'];
        $this->assertCount(3, $customers);
    }

}