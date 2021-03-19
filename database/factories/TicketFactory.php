<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = Ticket::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		return [
			'title' => $this->faker->realText($maxNbChars = 10, $indexSize = 2), 
			'message' => $this->faker->realText($maxNbChars = 50, $indexSize = 2), 
			'priority' => (bool)random_int(0, 1), 
			'status' => (bool)random_int(0, 1), 
			'pinned' => (bool)random_int(0, 1), 
			'public' => (bool)random_int(0, 1), 
			'channel' => "web", 
			'due_date' => $this->faker->dateTime
		];
	}
}
