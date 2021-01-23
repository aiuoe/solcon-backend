<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transactions', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('account_id');
			$table->unsignedBigInteger('sale_id');
			$table->decimal('amount', 65, 2);
			$table->timestamps();
			$table->foreign('account_id')->references('id')
			->on('accounts')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('sale_id')->references('id')
			->on('sales')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('transactions');
	}
}
