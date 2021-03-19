<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Relationship;
use App\Models\Language;
use App\Models\Origin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = User::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		return [
			'relp_id' => Relationship::all()->random()->id,
			'org_id' => Origin::all()->random()->id,
			'language_id' => Language::all()->random()->id, 
			'refd' => 1, 
			'name' => $this->faker->name,
			'lastname' => $this->faker->lastname,
			'email' => $this->faker->unique()->safeEmail,
			'email_verified_at' => now(),
			'password' => bcrypt('secret'), // password
			'remember_token' => Str::random(10),
		];
	}
}
