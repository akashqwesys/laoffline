<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanySwotDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_swot_details', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->string('strength');
            $table->string('weakness');
            $table->string('opportunity');
            $table->string('threat');
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
        Schema::dropIfExists('company_swot_details');
    }
}
