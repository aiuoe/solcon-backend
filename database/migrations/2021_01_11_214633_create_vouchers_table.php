<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vouchers', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('account_id');
			$table->unsignedBigInteger('period_id');
			$table->unsignedBigInteger('origin_id');
			$table->string('name');
      $table->longText('description');
      $table->longText('file');
			$table->enum('status', ['draft', 'review', 'allos']);
			$table->enum('origin', ['user', 'invoice', 'purchases', 'cxc', 'cxp', 'inventory', 'other']);
			$table->timestamps();
			$table->foreign('account_id')->references('id')
			->on('accounts')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('period_id')->references('id')
			->on('periods')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('vouchers');
	}
}
