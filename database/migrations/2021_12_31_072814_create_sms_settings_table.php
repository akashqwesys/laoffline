<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_settings', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id');
            $table->string('enquiry_general');
            $table->string('enquiry_supplier');
            $table->string('enquiry_footer_message');
            $table->string('enquiry_followup_general');
            $table->string('enquiry_followup_supplier');
            $table->string('order_general');
            $table->string('order_supplier');
            $table->string('order_footer_message');
            $table->string('order_followup_general');
            $table->string('order_followup_supplier');
            $table->string('complain_general');
            $table->string('complain_supplier');
            $table->string('complain_footer_message');
            $table->string('complain_followup_general');
            $table->string('complain_followup_supplier');
            $table->string('general_general');
            $table->string('general_supplier');
            $table->string('general_footer_message');
            $table->string('general_followup_general');
            $table->string('general_followup_supplier');
            $table->string('salebill_inward_general');
            $table->string('salebill_inward_supplier');
            $table->string('salebill_inward_footer_message');
            $table->string('salebill_outward_followup_general');
            $table->string('salebill_outward_followup_supplier');
            $table->string('salebill_outward_followup_footer_message');
            $table->string('salebill_followup_general');
            $table->string('salebill_followup_supplier');
            $table->string('payment_general');
            $table->string('payment_supplier');
            $table->string('payment_footer_message');
            $table->string('payment_outward_followup_general');
            $table->string('payment_outward_followup_supplier');
            $table->string('payment_outward_footer_message');
            $table->string('payment_followup_general');
            $table->string('payment_followup_supplier');
            $table->string('commission_general');
            $table->string('commission_supplier');
            $table->string('commission_footer_message');
            $table->string('commission_followup_general');
            $table->string('commission_followup_supplier');
            $table->string('automated_payment_general');
            $table->string('automated_payment_supplier');
            $table->string('automated_payment_footer_message');
            $table->string('automated_commission_followup_general');
            $table->string('automated_commission_followup_supplier');
            $table->string('automated_commission_followup_footer_message');
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
        Schema::dropIfExists('sms_settings');
    }
}
