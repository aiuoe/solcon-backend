<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabelsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('labels', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('company_id');
			$table->string('name');
      $table->longText('description');
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
		Schema::dropIfExists('labels');
	}
}
