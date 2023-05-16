<?php

namespace App\Domains\Customer\Infrastructure\Persistence\Factories;

use App\Domains\Customer\Domain\Model\CustomerModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Domains\Customer\Domain\Customers\Entities\\App\Domains\Customer\Domain\Model\CustomerModel>
 */
class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomerModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->unique()->firstName(),
            'date_of_birth' => fake()->unique()->date(),
            'last_name' => fake()->unique()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'phone_number' => fake()->unique()->phoneNumber(),
            'bank_account_number' => fake()->numerify('####-####-####-####'),
        ];
    }
}
