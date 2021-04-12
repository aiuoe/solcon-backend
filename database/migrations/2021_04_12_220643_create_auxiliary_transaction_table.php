<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuxiliaryTransactionTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('auxiliary_transaction', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('auxiliary_id');
			$table->unsignedBigInteger('transaction_id');
			$table->unsignedBigInteger('currency_id');
			$table->decimal('amount', 65, 2);
			$table->timestamps();
			$table->foreign('auxiliary_id')->references('id')
			->on('auxiliaries')->onDelete('cascade')->onUpdate('cascade');
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
		Schema::dropIfExists('auxiliary_transaction');
	}
}
