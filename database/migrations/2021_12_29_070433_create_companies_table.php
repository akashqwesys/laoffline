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
            $table->string('company_name')->nullable();
            $table->string('company_type')->nullable();
            $table->string('company_country')->nullable();
            $table->string('company_state')->nullable();
            $table->string('company_city')->nullable();
            $table->string('company_website')->nullable();
            $table->text('company_landline')->nullable();
            $table->string('company_mobile')->nullable();
            $table->string('company_watchout')->nullable();
            $table->text('company_remark_watchout')->nullable();
            $table->text('company_about')->nullable();
            $table->string('company_category')->nullable();
            $table->string('product_category')->nullable();
            $table->string('product_sub_category')->nullable();
            $table->integer('company_transport')->default('0');
            $table->string('company_discount')->nullable();
            $table->integer('company_payment_terms_in_days')->default('0');
            $table->string('company_opening_balance')->nullable();
            $table->integer('favorite_flag')->default('0');
            $table->integer('is_verified')->default('0');
            $table->integer('verified_by')->default('0');
            $table->integer('generated_by')->default('0');
            $table->integer('updated_by')->default('0');
            $table->integer('is_linked')->default('0');
            $table->integer('is_active')->default('0');
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
