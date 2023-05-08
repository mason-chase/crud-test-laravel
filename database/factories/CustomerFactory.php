<?php

namespace Database\Factories;

use App\Models\Customer;
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
			'firstName'         => fake()->firstName(),
			'lastName'          => fake()->lastName(),
			'dateOfBirth'       => fake()->date(),
			'phoneNumber'       => '98912123'.rand(1111,9999),
			'email'             => fake()->email(),
			'bankAccountNumber' => fake()->numberBetween( 111111, 99999 ),
		];
	}

}
