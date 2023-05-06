<?php

namespace App\Domain\Customer\database\factories;

use App\Domain\Customer\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Customer\Models\>
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
            Customer::COL_UUID => Str::uuid()->toString(),
            Customer::COL_FIRST_NAME => $this->faker->firstName,
            Customer::COL_LAST_NAME => $this->faker->lastName,
            Customer::COL_EMAIL => $this->faker->email,
            Customer::COL_PHONE_NUMBER => $this->faker->phoneNumber,
            Customer::COL_DATE_OF_BIRTH => $this->faker->date(),
            Customer::COL_BACK_ACCOUNT_NUMBER => $this->faker->randomDigit(),
        ];
    }
}
