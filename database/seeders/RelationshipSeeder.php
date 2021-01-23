<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class RelationshipSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
  	DB::table('relationships')->upsert([
  		[
        'id' => 1, 
        'name' => 'lic', 
        'created_at' => Carbon::now(), 
        'updated_at' => Carbon::now()
      ],
  		[
        'id' => 2, 
        'name' => 'licda', 
        'created_at' => Carbon::now(), 
        'updated_at' => Carbon::now()
      ],
  		[
        'id' => 3, 
        'name' => 'dr', 
        'created_at' => Carbon::now(), 
        'updated_at' => Carbon::now()
      ],
  		[
        'id' => 4, 
        'name' => 'dra', 
        'created_at' => Carbon::now(), 
        'updated_at' => Carbon::now()
      ],
      [
        'id' => 5, 
        'name' => 'sr', 
        'created_at' => Carbon::now(), 
        'updated_at' => Carbon::now()
      ],
      [
        'id' => 6, 
        'name' => 'sra', 
        'created_at' => Carbon::now(), 
        'updated_at' => Carbon::now()
      ],
      [
        'id' => 7, 
        'name' => 'srta', 
        'created_at' => Carbon::now(), 
        'updated_at' => Carbon::now()
      ],
      [
        'id' => 8, 
        'name' => 'ing', 
        'created_at' => Carbon::now(), 
        'updated_at' => Carbon::now()
      ],
      [
        'id' => 9, 
        'name' => 'prof', 
        'created_at' => Carbon::now(), 
        'updated_at' => Carbon::now()
      ],
  	], ['id']);
  }
}