<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabelVoucherTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('label_voucher', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('label_id');
			$table->unsignedBigInteger('voucher_id');
			$table->timestamps();
			$table->foreign('label_id')->references('id')
			->on('labels')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('voucher_id')->references('id')
			->on('vouchers')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('label_voucher');
	}
}
