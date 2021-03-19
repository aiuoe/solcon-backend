<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('currency_id');
            $table->unsignedBigInteger('tax_id');
            $table->string('name');
            $table->string('description');
            $table->decimal('price', 65, 2);
            $table->timestamps();
            $table->foreign('company_id')->references('id')
            ->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('currency_id')->references('id')
            ->on('currencies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tax_id')->references('id')
            ->on('taxes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
