<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CurrencySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
  	DB::table('currencies')->upsert([
  		[
  			'id' => 1, 
  			'name' => 'peso argentino', 
  			'abbreviation' => 'ars', 
  			'created_at' => Carbon::now(), 
  			'updated_at' => Carbon::now()
  		],
  		[
  			'id' => 2, 
  			'name' => 'boliviano boliviano', 
  			'abbreviation' => 'bob', 
  			'created_at' => Carbon::now(), 
  			'updated_at' => Carbon::now()
  		],
  		[
  			'id' => 3, 
  			'name' => 'peso chileno', 
  			'abbreviation' => 'clp', 
  			'created_at' => Carbon::now(), 
  			'updated_at' => Carbon::now()
  		],
  		[
  			'id' => 4, 
  			'name' => 'peso colombiano', 
  			'abbreviation' => 'cop', 
  			'created_at' => Carbon::now(), 
  			'updated_at' => Carbon::now()
  		],
  		[
  			'id' => 5, 
  			'name' => 'colon costarricense', 
  			'abbreviation' => 'crc', 
  			'created_at' => Carbon::now(), 
  			'updated_at' => Carbon::now()
  		],
  		[
  			'id' => 6, 
  			'name' => 'dolar estadounidense', 
  			'abbreviation' => 'usd', 
  			'created_at' => Carbon::now(), 
  			'updated_at' => Carbon::now()
  		],
  		[
  			'id' => 7, 
  			'name' => 'euro', 
  			'abbreviation' => 'eur', 
  			'created_at' => Carbon::now(), 
  			'updated_at' => Carbon::now()
  		],
  		[
  			'id' => 8, 
  			'name' => 'quetzal guatemalteco', 
  			'abbreviation' => 'gtq', 
  			'created_at' => Carbon::now(), 
  			'updated_at' => Carbon::now()
  		],
  		[
  			'id' => 9, 
  			'name' => 'lempira hondureña', 
  			'abbreviation' => 'hnl', 
  			'created_at' => Carbon::now(), 
  			'updated_at' => Carbon::now()
  		],
  		[
  			'id' => 10, 
  			'name' => 'peso mexicano', 
  			'abbreviation' => 'mxn', 
  			'created_at' => Carbon::now(), 
  			'updated_at' => Carbon::now()
  		],
  		[
  			'id' => 11, 
  			'name' => 'cordoba nicaraguense', 
  			'abbreviation' => 'nio', 
  			'created_at' => Carbon::now(), 
  			'updated_at' => Carbon::now()
  		],
  		[
  			'id' => 12, 
  			'name' => 'balboa panameño', 
  			'abbreviation' => 'pab', 
  			'created_at' => Carbon::now(), 
  			'updated_at' => Carbon::now()
  		],
  		[
  			'id' => 13, 
  			'name' => 'guarani paraguayo', 
  			'abbreviation' => 'pyg', 
  			'created_at' => Carbon::now(), 
  			'updated_at' => Carbon::now()
  		],
  		[
  			'id' => 14, 
  			'name' => 'sol peruano', 
  			'abbreviation' => 'pen', 
  			'created_at' => Carbon::now(), 
  			'updated_at' => Carbon::now()
  		],
  		[
  			'id' => 15, 
  			'name' => 'peso dominicano', 
  			'abbreviation' => 'dop', 
  			'created_at' => Carbon::now(), 
  			'updated_at' => Carbon::now()
  		],
  		[
  			'id' => 16, 
  			'name' => 'peso uruguayo', 
  			'abbreviation' => 'uyu', 
  			'created_at' => Carbon::now(), 
  			'updated_at' => Carbon::now()
  		],
  		[
  			'id' => 17, 
  			'name' => 'bolivar soberano venezolano', 
  			'abbreviation' => 'ves', 
  			'created_at' => Carbon::now(), 
  			'updated_at' => Carbon::now()
  		],
  	], ['id']);
  }
}
