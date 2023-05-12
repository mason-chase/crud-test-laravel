<?php

namespace Test\CustomerManager\Models\Repositories;

use Behzi\BusinessManagement\App\Helper\BaceRepository;
use Test\CustomerManager\Models\Customer;

class CustomerRepository extends BaceRepository {

    public static function Load() : Array
    {
        return [

        ];
    }

    public function get(Array $filters)
    {
        $customer = Customer::with(self::Load())->query();

        if (self::checkIsList('accountNumbers', $filters))
        {
            $customer->inBankAccountList($filters['accountNumbers']);
        }

        if(self::checkIsList('emails', $filters))
        {
            $customer->inEmailList($filters['emails']);
        }

        return $customer->paginate();
    }

    public function show(int $id)
    {
        return Customer::with(self::Load())->findOrFail($id);
    }

    public function create(int $id, Array $data)
    {
        return Customer::createOrFaild($data);
    }

    public function update(int $id, Array $data)
    {
        return Customer::findOrFail($id)
            ->update($data);
    }

    public function delete(int $id)
    {
        Customer::findOrFail($id)
            ->delete();
    }

}