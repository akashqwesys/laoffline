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
            $table->string('company_country');
            $table->string('company_state');
            $table->string('company_city');
            $table->string('company_website');
            $table->text('company_landline');
            $table->string('company_mobile');
            $table->string('company_watchout');
            $table->text('company_remark_watchout');
            $table->text('company_about');
            $table->string('company_category');
            $table->string('product_category')->nullable();
            $table->string('product_sub_category')->nullable();
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
            $table->integer('is_active');
            $table->timestamp('verified_date')->nullable();
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
