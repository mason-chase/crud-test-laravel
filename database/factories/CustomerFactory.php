<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;
use Src\Customer\Domain\Entities\CustomerModel;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
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
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'date_of_birth' => now()->subYears(rand(20, 45))->format('Y-m-d'),
//            'phone_number' => $this->faker->phoneNumber(),
            'phone_number' => '+989163675575',
            'email' => $this->faker->email,
            'bank_account_number' => $this->faker->numerify("############"),
            'uuid' => Uuid::uuid4()
        ];
    }
}
