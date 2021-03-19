<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sales', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('account_id')->nullable();
			$table->unsignedBigInteger('user_id')->nullable();
			$table->unsignedBigInteger('currency_id');
			$table->decimal('discount', 65, 2);
			$table->decimal('taxes', 65, 2);
			$table->decimal('amount', 65, 2);
			$table->boolean('paid')->default(false);
			$table->timestamp('due_date');
			$table->timestamps();
			$table->foreign('account_id')->references('id')
			->on('accounts')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('currency_id')->references('id')
			->on('currencies')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('user_id')->references('id')
			->on('users')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('sales');
	}
}
