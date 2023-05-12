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
    public function index()
    {
        return Customer::select('id', 'first_name', 'last_name', 'date_of_birth', 'phone_number', 'email', 'bank_account_number')
            ->paginate();
    }

    public function show($id)
    {
        try {
            return Customer::where('id', '=', $id)->firstOrFail();

        } catch (Exception $exception) {
            Log::debug('CustomerService@show', [
                'message' => $exception->getMessage(),
                'errorCode' => $exception->getCode(),
                'data' => 'customer_id:' . $id,
            ]);

            return ApiResponse::failed(Response::HTTP_INTERNAL_SERVER_ERROR, 'customer not found');
        }
    }

    public function store($request)
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

            return $customer;
        } catch (Exception $exception) {
            Log::debug('CustomerService@store', [
                'message' => $exception->getMessage(),
                'errorCode' => $exception->getCode(),
                'data' => $request,
            ]);

            return ApiResponse::failed(Response::HTTP_INTERNAL_SERVER_ERROR, 'internal server error');
        }
    }

    public function update($request, $id): JsonResponse
    {
        try {
            $customer = Customer::where('id', '=', $id)->firstOrFail();
            $customer->first_name = $request->first_name;
            $customer->last_name = $request->last_name;
            $customer->date_of_birth = $request->date_of_birth;
            $customer->phone_number = $request->phone_number;
            $customer->email = $request->email;
            $customer->bank_account_number = $request->bank_account_number;
            $customer->save();

            return ApiResponse::success('customer updated successfully!', $customer);
        } catch (Exception $exception) {
            Log::debug('CustomerService@update', [
                'message' => $exception->getMessage(),
                'errorCode' => $exception->getCode(),
                'data' => $request,
            ]);

            return ApiResponse::failed(Response::HTTP_INTERNAL_SERVER_ERROR, 'internal server error');
        }
    }

    public function destroy($id)
    {
        try {
            $customer = Customer::where('id', '=', $id)->firstOrFail();
            $customer->delete();

            return response()->noContent();
        } catch (Exception $exception) {
            Log::debug('CustomerService@destroy', [
                'message' => $exception->getMessage(),
                'errorCode' => $exception->getCode(),
                'data' => 'customer_id:' . $id,
            ]);

            return ApiResponse::failed(Response::HTTP_INTERNAL_SERVER_ERROR, 'internal server error');
        }
    }
}
