<?php

namespace App\Http\Controllers\Customers;

use App\Domains\Customer\Application\Commands\DeleteCustomerCommand;
use App\Domains\Customer\Application\Handler\DeleteCustomerHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class DeleteCustomerController extends Controller
{
    public function __construct(protected DeleteCustomerHandler $handler)
    {
    }

    public function __invoke(int $id): JsonResponse
    {
        $query = new DeleteCustomerCommand(id: $id);
        $this->handler->handle($query);

        return $this->accepted();
    }
}
