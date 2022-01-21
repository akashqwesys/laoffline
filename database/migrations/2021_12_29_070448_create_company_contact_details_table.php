<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyContactDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_contact_details', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->string('contact_persion_name');
            $table->string('contact_persion_designation');
            $table->string('contact_persion_profile_pic');
            $table->string('contact_persion_mobile');
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
        Schema::dropIfExists('company_contact_details');
    }
}
