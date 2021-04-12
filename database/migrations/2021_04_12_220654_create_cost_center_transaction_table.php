<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostCenterTransactionTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cost_center_transaction', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('cost_center_id');
			$table->unsignedBigInteger('transaction_id');
			$table->unsignedBigInteger('currency_id');
			$table->decimal('amount', 65, 2);
			$table->timestamps();
			$table->foreign('cost_center_id')->references('id')
			->on('cost_centers')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('transaction_id')->references('id')
			->on('transactions')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('currency_id')->references('id')
			->on('currencies')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('cost_center_transaction');
	}
}
