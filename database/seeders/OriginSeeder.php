<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OriginSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
		DB::table('origins')->upsert([
			[
				'id' => 1,
				'name' => 'web',
				'created_at' => Carbon::now(), 
				'updated_at' => Carbon::now()
			],
			[
				'id' => 2,
				'name' => 'por un amigo',
				'created_at' => Carbon::now(), 
				'updated_at' => Carbon::now()
			],
			[
				'id' => 3,
				'name' => 'instagram',
				'created_at' => Carbon::now(), 
				'updated_at' => Carbon::now()
			],
			[
				'id' => 4,
				'name' => 'facebook',
				'created_at' => Carbon::now(), 
				'updated_at' => Carbon::now()
			],
			[
				'id' => 5,
				'name' => 'correo electrónico',
				'created_at' => Carbon::now(), 
				'updated_at' => Carbon::now()
			],
			[
				'id' => 6,
				'name' => 'taller',
				'created_at' => Carbon::now(), 
				'updated_at' => Carbon::now()
			],
			[
				'id' => 7,
				'name' => 'por el trabajo',
				'created_at' => Carbon::now(), 
				'updated_at' => Carbon::now()
			],
			[
				'id' => 8,
				'name' => 'otro',
				'created_at' => Carbon::now(), 
				'updated_at' => Carbon::now()
			],
		], ['id']);
  }
}
