<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('company_type');
            $table->integer('company_country');
            $table->integer('company_state');
            $table->integer('company_city');
            $table->string('company_website');
            $table->string('company_landline');
            $table->string('company_mobile');
            $table->string('company_watchout');
            $table->string('company_remark_watchout');
            $table->string('company_about');
            $table->integer('company_category');
            $table->integer('company_transport');
            $table->string('company_discount');
            $table->integer('company_payment_terms_in_days');
            $table->string('company_opening_balance');
            $table->integer('favorite_flag');
            $table->integer('is_verified');
            $table->integer('verified_by');
            $table->integer('generated_by');
            $table->integer('updated_by');
            $table->integer('is_linked');
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
        Schema::dropIfExists('companies');
    }
}
