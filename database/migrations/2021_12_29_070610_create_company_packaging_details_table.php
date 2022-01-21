<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyPackagingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_packaging_details', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->string('gst_no');
            $table->string('cst_no');
            $table->string('tin_no');
            $table->string('vat_no');
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
        Schema::dropIfExists('company_packaging_details');
    }
}
