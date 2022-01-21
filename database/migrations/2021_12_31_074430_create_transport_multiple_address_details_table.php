<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportMultipleAddressDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transport_multiple_address_details', function (Blueprint $table) {
            $table->id();
            $table->string('transport_details');
            $table->string('contact_person_name');
            $table->string('contact_person_address');
            $table->string('contact_person_office_no');
            $table->string('contact_person_email');
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
        Schema::dropIfExists('transport_multiple_address_details');
    }
}
