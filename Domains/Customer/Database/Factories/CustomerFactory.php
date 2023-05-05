<?php

namespace Domains\Customer\Database\Factories;


use Domains\Customer\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
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
            'first_name' => fake()->name(),
            'last_name' => fake()->lastName(),
            'date_of_birth' => fake()->dateTimeBetween($startDate = '-70 years', $endDate = '-2 years', $timezone = null)->format('Y-m-d'),
            'phone_number' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'bank_account_number' => fake()->numerify('####-####-####-####'),
        ];
    }
}
