<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	  	DB::table('users')->upsert([
	  		[
	  			'id' => 1,
	  			'relp_id' => 1,
	  			'language_id' => 1,
	  			'org_id' => 1,
	  			'refd' => 1,
	  			'name' => 'ruben',
	  			'lastname' => 'cortez',
	  			'email' => 'ruben@dev.com',
	  			'password' => bcrypt('secret'),
	        'created_at' => Carbon::now(), 
	        'updated_at' => Carbon::now()
	      ],
	      [
	  			'id' => 2,
	  			'relp_id' => 1,
	  			'language_id' => 1,
	  			'org_id' => 1,
	  			'refd' => 1,
	  			'name' => 'genesis',
	  			'lastname' => 'pineda',
	  			'email' => 'genesis@design.com',
	  			'password' => bcrypt('secret'),
	        'created_at' => Carbon::now(), 
	        'updated_at' => Carbon::now()
	      ]
    	], ['id']);
    }
}
