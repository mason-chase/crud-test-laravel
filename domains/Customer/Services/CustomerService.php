<?php

namespace Domains\Customer\Services;

use Domains\Customer\Models\Customer;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Utility\ApiResponse;
use Exception;

class CustomerService
{
    public function index(): JsonResponse
    {
        $customers = Customer::all();

        return ApiResponse::success(__('customer.customer.list'), $customers);
    }

    public function show(int $id): JsonResponse
    {
        try {
            $customer = Customer::where('id', '=', $id)->firstOrFail();

            return ApiResponse::success(__('customer.customer.show'), $customer);
        } catch (Exception $exception) {
            Log::debug('CustomerService@show', [
                'message' => $exception->getMessage(),
                'errorCode' => $exception->getCode(),
                'data' => 'customer_id:' . $id,
            ]);

            return ApiResponse::failed(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                __('customer.customer.not_found'));
        }
    }

    public function store($request): JsonResponse
    {
        try {
            $customer = new Customer();
            $customer->first_name = $request->first_name;
            $customer->last_name = $request->last_name;
            $customer->date_of_birth = $request->date_of_birth;
            $customer->phone_number = $request->phone_number;
            $customer->email = $request->email;
            $customer->bank_account_number = $request->bank_account_number;
            $customer->save();

            return ApiResponse::success(__('customer.customer.store'), $customer);
        } catch (Exception $exception) {
            Log::debug('CustomerService@store', [
                'message' => $exception->getMessage(),
                'errorCode' => $exception->getCode(),
                'data' => $request,
            ]);

            return ApiResponse::failed(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                __('customer.customer.server_error'));
        }
    }

    public function update($request, int $id): JsonResponse
    {
        try {
            $customer = Customer::where('id', '=', $id)
                ->update($request);

            return ApiResponse::success(__('customer.customer.update'), $customer);
        } catch (Exception $exception) {
            Log::debug('CustomerService@update', [
                'message' => $exception->getMessage(),
                'errorCode' => $exception->getCode(),
                'data' => $request,
            ]);

            return ApiResponse::failed(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                __('customer.customer.server_error'));
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            Customer::where('id', '=', $id)->delete();

            return ApiResponse::success(__('customer.customer.delete'));
        } catch (Exception $exception) {
            Log::debug('CustomerService@destroy', [
                'message' => $exception->getMessage(),
                'errorCode' => $exception->getCode(),
                'data' => 'customer_id:' . $id,
            ]);

            return ApiResponse::failed(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                __('customer.customer.server_error'));
        }
    }
}
