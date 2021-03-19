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
			$table->unsignedBigInteger('parent_id')->nullable();
			$table->enum('type', ['active', 'passive', 'patrimony', 'income', 'expense']);
			$table->string('name');
			$table->longText('description')->nullable();
			$table->decimal('balance', 65, 2);
			$table->timestamps();
			$table->foreign('company_id')->references('id')
			->on('companies')->onDelete('cascade')->onUpdate('cascade');            
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
