<?php

namespace Test\CustomerManager\Models\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use Test\CustomerManager\App\Helper\BaceRepository;
use Test\CustomerManager\Models\Customer;

class CustomerRepository extends BaceRepository {

    public static function Load() : Array
    {
        return [

        ];
    }

    public function get(Array $filters) : LengthAwarePaginator
    {
        $customer = Customer::with(self::Load());

        if (self::checkIsList('accountNumbers', $filters['filters'] ?? []))
        {
            $customer->inBankAccountList($filters['filters']['accountNumbers']);
        }

        if(self::checkIsList('emails', $filters['filters'] ?? [] ))
        {
            $customer->inEmailList($filters['filters']['emails']);
        }

        return $customer->paginate();
    }

    public function show(int $id)
    {
        return Customer::with(self::Load())->findOrFail($id);
    }

    public function create(Array $data)
    {
        return Customer::Create($data);
    }

    public function update(int $id, Array $data)
    {
        $customer = Customer::findOrFail($id);
        $customer->update($data);
        return $this->show($customer->id);
    }

    public function delete(int $id)
    {
        Customer::findOrFail($id)
            ->delete();
    }

}