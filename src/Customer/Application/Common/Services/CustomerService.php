<?php

namespace Src\Customer\Application\Common\Services;

use Illuminate\Support\Facades\Log;
use Src\Customer\Application\Common\Interfaces\CustomerServiceInterface;
use Src\Customer\Application\Items\Commands\CreateCustomerCommand;
use Src\Customer\Application\Items\Queries\IsCustomerExistsQuery;
use Symfony\Component\HttpFoundation\Response;

class CustomerService implements CustomerServiceInterface
{

    public function __construct(
        protected CreateCustomerCommand $createCommand
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


}
