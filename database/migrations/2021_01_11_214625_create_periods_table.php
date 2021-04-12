<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('periods', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('company_id');
			$table->timestamp('beginning');
			$table->timestamp('closing');
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
		Schema::dropIfExists('periods');
	}
}
