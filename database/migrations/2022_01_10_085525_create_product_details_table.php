<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('catalogue_price');
            $table->integer('average_price');
            $table->integer('wholesale_discount');
            $table->integer('wholesale_brokerage');
            $table->integer('total_wholesale_discount');
            $table->integer('retail_discount');
            $table->integer('retail_brokerage');
            $table->integer('totl_retail_discount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_details');
    }
}
