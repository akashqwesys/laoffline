<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_references', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->string('ref_person_name');
            $table->string('ref_person_mobile');
            $table->string('ref_person_company');
            $table->string('ref_person_address');
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
        Schema::dropIfExists('company_references');
    }
}
