<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accounts', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('company_id');
			$table->unsignedBigInteger('currency_id');
			$table->unsignedBigInteger('tax_id');
			$table->unsignedBigInteger('parent_id')->nullable();
			$table->string('name');
			$table->string('code');
			$table->boolean('enabled');
			$table->boolean('movement');
			$table->boolean('auxiliary');
			$table->boolean('lock_setting');
			$table->boolean('confidential');
			$table->enum('departure', ['monetary', 'no_monetary']);
			$table->enum('activity', ['cash', 'operations', 'investment', 'financing']);
			$table->enum('count_of', ['cash', 'assets', 'fixed_assets', 'intangibles']);
			$table->timestamps();
			$table->foreign('company_id')->references('id')
			->on('companies')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('currency_id')->references('id')
			->on('currencies')->onDelete('cascade')->onUpdate('cascade'); 
			$table->foreign('tax_id')->references('id')
			->on('taxes')->onDelete('cascade')->onUpdate('cascade');            
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('accounts');
	}
}
