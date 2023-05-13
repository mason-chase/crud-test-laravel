<?php

namespace Database\Factories;

use App\Utilities\Text\TokenGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->email,
            'phone_number' => '+98912' . TokenGenerator::number(7),
            'date_of_brith' => $this->faker->date('Y-m-d'),
            'bank_account_number' => TokenGenerator::number(8),
        ];
    }
}
