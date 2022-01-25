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
            $table->string('product_name');
            $table->string('catalogue_name');
            $table->string('brand_name');
            $table->string('model');
            $table->date('launch_date')->nullable();
            $table->integer('company');
            $table->integer('category');
            $table->string('sub_category');
            $table->string('main_image');
            $table->string('price_list_image');
            $table->text('description');
            $table->string('complete_flag');
            $table->string('generated_by');
            $table->string('updated_by');
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
        Schema::dropIfExists('products');
    }
}
