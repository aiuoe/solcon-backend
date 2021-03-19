<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->enum('label', ['home', 'Shipping']);
            $table->string('address');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('zip_code');
            $table->timestamps();
            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('addresses');
    }
}
