<?php

namespace Src\Customer\Application\Common\Services;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Src\Customer\Application\Common\Interfaces\CustomerServiceInterface;
use Src\Customer\Application\Items\Commands\CreateCustomerCommand;
use Src\Customer\Application\Items\Commands\DeleteCustomerCommand;
use Src\Customer\Application\Items\Commands\UpdateCustomerCommand;
use Src\Customer\Application\Items\Queries\FindCustomerByIdQuery;
use Src\Customer\Application\Items\Queries\IsCustomerExistsQuery;
use Symfony\Component\HttpFoundation\Response;

class CustomerService implements CustomerServiceInterface
{

    public function __construct(
        protected CreateCustomerCommand $createCommand,
        protected FindCustomerByIdQuery $findCustomerByIdQuery,
        protected UpdateCustomerCommand $updateCustomerCommand,
        protected DeleteCustomerCommand $deleteCustomerCommand
    )
    {
    }

    public function checkExistenceByFields(array $fields)
    {
        return IsCustomerExistsQuery::handle($fields);
    }

    public function save(array $data)
    {
        try {
            $this->createCommand->handle($data);

            $message = 'Customer created.';

            $statusCode = Response::HTTP_CREATED;

        } catch (\Exception $exception) {
            Log::error($exception);

            $message = 'Create customer error.';

            $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return response()->json(['message' => $message], $statusCode);
    }

    public function update(array $customerData, int $customerId)
    {
        try {
            $customer = $this->findCustomerByIdQuery->handle($customerId);

            $customerData['uuid'] = $customer->uuid;

            $this->updateCustomerCommand->handle($customerData, $customer);

            $message = "Update customer successfully.";

            $statusCode = Response::HTTP_ACCEPTED;

        } catch (ModelNotFoundException $exception) {
            $message = $exception->getMessage();

            $statusCode = Response::HTTP_NOT_FOUND;
        } catch (\Exception $exception) {
            Log::error($exception);

            $message = 'Update customer error.';

            $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return response()->json(['message' => $message], $statusCode);
    }

    public function delete(int $customerId)
    {
        try {
            $customer = $this->findCustomerByIdQuery->handle($customerId);

            $this->deleteCustomerCommand->handle($customer);

            $message = "Delete customer successfully.";

            $statusCode = Response::HTTP_OK;

        } catch (ModelNotFoundException $exception) {
            $message = $exception->getMessage();

            $statusCode = Response::HTTP_NOT_FOUND;
        } catch (\Exception $exception) {
            Log::error($exception);

            $message = 'Update customer error.';

            $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return response()->json(['message' => $message], $statusCode);
    }


}
