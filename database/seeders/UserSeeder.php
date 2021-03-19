<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Ticket;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		User::factory(10)
		->hasCompanies(2)
		->hasAddresses(4)
		->hasEmails(5)
		->hasPhones(6)
		->hasAttached(
			Ticket::factory(1000)->create(),
			[
			'created_by' => (bool)random_int(0, 1),
			'updated_by' => (bool)random_int(0, 1),
			'closed_by' => (bool)random_int(0, 1),
		])
		->create();
	}
}
