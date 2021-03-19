<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call(RelationshipSeeder::class);
		$this->call(CurrencySeeder::class);
		$this->call(OriginSeeder::class);
		$this->call(LanguageSeeder::class);
		$this->call(UserSeeder::class);
	}
}
