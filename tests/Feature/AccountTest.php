<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AccountTest extends TestCase
{
	use RefreshDatabase;

	protected $seed = true;

	/**
	 * A basic feature test example.
	 *
	 * @return void
	 */
	public function test_account()
	{
		$user = User::factory()->create();
		$this->actingAs($user, 'api');
		
		$company = $this->graphQl('mutation
			{
			  companyUpsert(input:
			  {
			    name: "solcon"
			    rif: "j24549594"
			    fyc: "2021-12-31"
			  })
			  {
			    id
			    name
			    rif
			    fyc
			    user_id
			    {
			    	id
			    	name
			    }
			  }
			}');
		
		$company->assertStatus(200);
		// $company->dump();

		$account = $this->graphQl('mutation
			{
			  accountUpsert(input: 
			  {
			    name: "ventas"
			    company_id: ' . $company["data"]["companyUpsert"]["id"] . '
			    balance: 1500 
			    type: income
			  })
			  {
			    id
			    name
		    	balance
		    	type
			    company_id
			    {
			    	id
			    	name
			    	user_id
			    	{
			    		id
			    		name
			    	}
			    }
			  }
			}');
		
		$account->assertStatus(200);
		// $account->dump();

		$accounts = $this->graphQl('query
			{
			  accounts(page: 1 id: ' .$company["data"]["companyUpsert"]["id"] . ')
			  {
			    id
			    parent_id
			    company_id
			    {
			      id
			      name
			      user_id
			      {
			      	id
			      	name
			      }
			    }
			    name
			    balance
			    type
			  }
			}');
		$accounts->assertStatus(200);
		$accounts->dump();	
	}
}
