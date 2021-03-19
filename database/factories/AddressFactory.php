<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = Address::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		return [
	  	'label' => 'home', 
	  	'address' => $this->faker->address, 
	  	'city' => $this->faker->city, 
	  	'state' => $this->faker->state,
	  	'country' => $this->faker->country, 
	  	'zip_code' => $this->faker->postcode
		];
	}
}
