<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    //use RefreshDatabase;
    /**
     * A basic test example.
     */
    public function test_index_customer(): void
    {
        $response = $this->get('/api/customers/');

        $response->assertStatus(200);
    }

    public function test_store_customer()
    {
        $this->withoutExceptionHandling();

        $this->postJson('/api/customers', [
            'first_name' => 'farhad',
            'last_name' => 'yozbashi',
            'phone_number' => '09365576035',
            'date_of_birth' => '6/23/1995',
            'email' => 'f.yosbashi@gmail.com',
            'bank_account_number' => '5269874569823654',
        ])->assertStatus(201);
    }

    public function test_update_customer()
    {
        $this->withoutExceptionHandling();

        $this->putJson('/api/customers/1', [
            'first_name' => 'farhad2',
            'last_name' => 'yozbashi',
            'phone_number' => '09365576035',
            'date_of_birth' => '6/23/1995',
            'email' => 'f.yosbashi@gmail.com',
            'bank_account_number' => '5269874569823654',
        ])->assertStatus(200);
    }

    public function test_delete_customer()
    {
        $response = $this->delete('/api/customers/1');

        $response->assertStatus(200);
    }
}
