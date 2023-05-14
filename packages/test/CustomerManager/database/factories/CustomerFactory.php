<?php

namespace Test\CustomerManager\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Test\CustomerManager\Models\Customer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'date_of_birth' => $this->faker->date(),
            'phone_number' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'bank_account_number' => random_int(0000000000, 9999999999),
        ];
    }
}
