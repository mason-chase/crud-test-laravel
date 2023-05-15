<?php

namespace Test\CustomerManager\Tests\Unit;

use Test\CustomerManager\Models\Customer;
use Test\CustomerManager\Models\Repositories\CustomerRepository;
use Test\CustomerManager\Tests\TestCase;

class CustomerRepoTest extends TestCase {

    public function getRepo()
    {
        return new CustomerRepository();
    }

    function test_createCustomer()
    {
        $customer = Customer::factory()->create();
        $this->assertModelExists($customer);
    }
    

    public function test_getFirstCustomer()
    {
        $customer = Customer::factory()->create();
        $customer = Customer::first();
        $this->assertModelExists($customer);
    }

    public function test_UpdateCustomer()
    {
        $customer = Customer::factory()->create();
        $check = $customer->update([
            'bank_account_number' => random_int(0000000000, 9999999999)
        ]);

        $this->assertEquals(true,$check);
    }

    public function test_CreateCustomerRepo()  : CustomerRepository
    {
        $repo = new CustomerRepository();

        $this->assertInstanceOf(CustomerRepository::class , $repo);

        return $repo;
    }

    private function createCustomer_with_repo(CustomerRepository $repo) : Customer
    {
        $customer = Customer::factory()->make();
        return  $repo->create($customer->toArray());
    }

    /**
     *  @depends test_CreateCustomerRepo
    */
    public function test_CreateCustomerByRepository(CustomerRepository $repo) : Customer
    {
        $customer = $this->createCustomer_with_repo($repo);
        $this->assertInstanceOf(Customer::class, $customer);
        return $customer;
    }

    /**
     * @depends test_CreateCustomerRepo
     */
    public function test_update_ustomer_ByRepository(CustomerRepository $repo) : Customer
    {
        $old = $this->createCustomer_with_repo($repo);
        $new = $old->toArray();
        $new['bank_account_number'] = random_int(0000000000, 9999999999);
        $data = $repo->update($old->id, $new);
        $this->assertInstanceOf(Customer::class, $data);

        return $data;
    }

    /**
     * @depends test_CreateCustomerRepo
     */
    public function test_delete_customer_byRepository(CustomerRepository $repo)
    {
        $customer = $this->createCustomer_with_repo($repo);
        $repo->delete($customer->id);
        $data = $repo->get([]);
        $this->assertEquals(0,count($data));
    }

    /**
     * @depends test_CreateCustomerRepo
     */
    public function test_GetCustomerByRepository(CustomerRepository $repo)
    {
        $this->createCustomer_with_repo($repo);

        $data = $repo->get([]);
        $this->assertEquals(1,count($data));
    }
}