<?php

namespace Tests\Application\Customer\Handler;

use App\Models\User;
use Ddd\Application\Customers\Command\DeleteCustomerCommand;
use Ddd\Application\Customers\Handler\DeleteCustomerHandler;
use Ddd\Domain\Customers\CustomerRepositoryInterface;
use Ddd\Domain\Customers\Entities\CustomerModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Response;
use Mockery;
use Tests\TestCase;

class DeleteCustomerHandlerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    private DeleteCustomerHandler $handler;
    private CustomerRepositoryInterface $repository;
    private array $customerData;
    private array $fakeData;

    public function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();

        $this->repository = Mockery::mock(CustomerRepositoryInterface::class);
        $this->handler = new DeleteCustomerHandler($this->repository);
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

        $command = new DeleteCustomerCommand($customer->id);

        // Set up the expectations
        $this->repository->shouldReceive('delete')->once()->with($customer->id);

        // Call the handle method on the handler with the command
        $this->handler->handle($command);
    }

    public function test_it_can_delete_a_customer()
    {
        $this->loginUser();
        $customer = CustomerModel::factory()->create();

        $response = $this->delete(route('customers.destroy', $customer->id));
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('customers.index'));
        $this->assertDatabaseMissing('customers', $customer->toArray());
    }


}