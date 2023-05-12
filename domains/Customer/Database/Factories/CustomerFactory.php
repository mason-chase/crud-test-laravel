<?php

namespace Domains\Customer\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Domains\Customer\Models\Customer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domains\Customer\Models\Customer>
 */
class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'date_of_birth' => fake()->dateTimeBetween('-70 years', '-2 years')->format('Y-m-d'),
            'phone_number' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'bank_account_number' => fake()->numerify('####-####-####-####'),
        ];
    }
}
