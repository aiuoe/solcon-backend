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
            $table->unsignedBigInteger('relp_id');
            $table->unsignedBigInteger('org_id');
            $table->unsignedBigInteger('language_id');
            $table->enum('role', ['user', 'customer', 'staff', 'admin'])->default('user');
            $table->string('name');
            $table->string('lastname');
            $table->string('dni')->unique()->nullable();
            $table->string('rif')->unique()->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('refd')->default(1);
            $table->date('dob')->nullable();
            $table->integer('ext')->nullable();
            $table->enum('sex', ['male', 'female'])->nullable();
            $table->enum('sos', ['single', 'married', 'divorced', 'widower'])->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('language_id')->references('id')
            ->on('languages')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('relp_id')->references('id')
            ->on('relationships')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('org_id')->references('id')
            ->on('origins')->onDelete('cascade')->onUpdate('cascade');
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
