<?php

namespace App\Services;

use App\Helper\ResponseBuilder;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CustomerService {
  public function index(): JsonResponse
  {
    $items = Customer::all()->toArray();
    return $this->res( $items, "", Response::HTTP_OK);
  }
  public function store(array $customerData): JsonResponse
  {
    $items = Customer::create($customerData)->toArray();
    return $this->res( $items, __('messages.customers.success.stored'), Response::HTTP_CREATED);
  }
  public function show(int $customerId): JsonResponse
  {
    $items = Customer::where('id', $customerId)->firstOrFail()->toArray();
    return $this->res( $items, "", Response::HTTP_OK);
  }
  public function update(array $customerData, int $id): JsonResponse
  {
    Customer::where('id', $id)->update($customerData);
    $items = Customer::find($id)->first()->toArray();
    return $this->res( $items, __('messages.customers.success.updated', ['id' => $id]), Response::HTTP_ACCEPTED);
  }
  public function destroy(int $id): JsonResponse
  {
    Customer::where('id', $id)->delete();
    return $this->res( [], __('messages.customers.success.deleted', ['id' => $id]), Response::HTTP_ACCEPTED);
  }
  private function res($items, $message, $status){
    return ResponseBuilder
        ::items($items)
        ::message($message)
        ::statusCode($status)
        ::json();
  }
}