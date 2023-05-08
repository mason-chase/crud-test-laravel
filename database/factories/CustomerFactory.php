<?php

namespace Database\Factories;

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
			'firstName'         => fake()->firstName(),
			'lastName'          => fake()->lastName(),
			'dateOfBirth'       => fake()->date(),
			'phoneNumber'       => fake()->phoneNumber(),
			'email'             => fake()->email(),
			'bankAccountNumber' => fake()->numberBetween( 111111, 99999 ),
		];
	}
}
