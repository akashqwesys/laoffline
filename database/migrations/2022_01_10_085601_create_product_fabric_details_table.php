<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductFabricDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_fabric_details', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->string('saree_fabric');
            $table->integer('saree_cut');
            $table->string('blouse_fabric');
            $table->integer('blouse_cut');
            $table->string('top_fabric');
            $table->integer('top_cut');
            $table->string('bottom_fabric');
            $table->integer('bottom_cut');
            $table->string('dupatta_fabric');
            $table->integer('dupatta_cut');
            $table->string('inner_fabric');
            $table->integer('inner_cut');
            $table->string('sleeves_fabric');
            $table->integer('sleeves_cut');
            $table->string('choli_fabric');
            $table->integer('choli_cut');
            $table->string('lehenga_fabric');
            $table->integer('lehenga_cut');
            $table->string('lining_fabric');
            $table->integer('lining_cut');
            $table->string('gown_fabric');
            $table->integer('gown_cut');
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
        Schema::dropIfExists('product_fabric_details');
    }
}
