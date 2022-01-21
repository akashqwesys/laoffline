<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->text('profile_pic');
            $table->string('email_id');
            $table->string('mobile');
            $table->text('address');
            $table->integer('user_group');
            $table->integer('excel_access');
            $table->text('id_proof');
            $table->text('ref_full_name');
            $table->text('ref_pass_pic');
            $table->string('ref_mobile');
            $table->text('ref_address');
            $table->string('web_login');
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
        Schema::dropIfExists('employees');
    }
}
