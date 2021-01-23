<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LanguageSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
  	DB::table('languages')->upsert([
  		[
  			'id' => 1,
  			'abbreviation' => 'eng',
  			'name' => 'english',
        'created_at' => Carbon::now(), 
        'updated_at' => Carbon::now()
  		],
  		[
  			'id' => 2,
  			'abbreviation' => 'es',
  			'name' => 'español',
        'created_at' => Carbon::now(), 
        'updated_at' => Carbon::now()
  		],
  	], ['id']);
  }
}
