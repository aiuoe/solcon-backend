<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssociatedAccountTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('associated_account', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('account_id');
			$table->unsignedBigInteger('associated_id');
			$table->timestamps();
			$table->foreign('account_id')->references('id')
			->on('accounts')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('associated_id')->references('id')
			->on('associates')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('associated_account');
	}
}
