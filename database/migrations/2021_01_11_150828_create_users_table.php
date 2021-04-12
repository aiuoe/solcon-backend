<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('relationship_id');
			$table->unsignedBigInteger('language_id');
			$table->unsignedBigInteger('origin_id');
			$table->unsignedBigInteger('role_id');
			$table->string('name');
			$table->string('lastname');
			$table->string('dni')->unique()->nullable();
			$table->string('rif')->unique()->nullable();
			$table->string('email')->unique();
			$table->string('password');
			$table->integer('refd')->default(1);
			$table->date('birth_date')->nullable();
			$table->integer('ext')->nullable();
			$table->enum('sex', ['male', 'female'])->nullable();
			$table->enum('social_state', ['single', 'married', 'divorced', 'widower'])->nullable();
			$table->rememberToken();
			$table->timestamp('email_verified_at')->nullable();
			$table->timestamps();
			$table->foreign('relationship_id')->references('id')
			->on('relationships')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('language_id')->references('id')
			->on('languages')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('origin_id')->references('id')
			->on('origins')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('role_id')->references('id')
			->on('roles')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('users');
	}
}
