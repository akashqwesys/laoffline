<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Employee;
use App\Models\Logs;
use App\Models\Settings\SmsSettings;
use Illuminate\Support\Facades\Session;

class SmsSettingsController extends Controller
{
    use HasRoles;    

    public function index(Request $request) {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        $logs = new Logs;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Settings / SmsSettings / View';
        $logs->log_subject = 'Sms Settings view page visited.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();

        return view('settings.smsSettings.createSmsSetting')->with('employees', $employees);
    }

    public function editSmsSettings($id) {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        $employees['scope'] = 'edit';
        $employees['editedId'] = $id;

        return view('settings.smsSettings.editSmsSetting')->with('employees', $employees);
    }

    public function fetchSmsSettings($id) {        
        $smsSettingsData = SmsSettings::where('id', $id)->first();

        return $smsSettingsData;
    }

    public function updateSmsSettingsData(Request $request) {
        dd($request->All());
        $id = Session::get('user')->employee_id;

        $smsSettings = SmsSettings::where('employee_id', $id)->first();
        if ($smsSettings) {
            $smsSettings->enquiry_general = $request->enquiry_general;
            $smsSettings->enquiry_supplier = $request->enquiry_supplier;
            $smsSettings->enquiry_footer_message = $request->enquiry_footer_message;
            $smsSettings->enquiry_followup_general = $request->enquiry_followup_general;
            $smsSettings->enquiry_followup_supplier = $request->enquiry_followup_supplier;
            $smsSettings->order_general = $request->order_general;
            $smsSettings->order_supplier = $request->order_supplier;
            $smsSettings->order_footer_message = $request->order_footer_message;
            $smsSettings->order_followup_general = $request->order_followup_general;
            $smsSettings->order_followup_supplier = $request->order_followup_supplier;
            $smsSettings->complain_general = $request->complain_general;
            $smsSettings->complain_supplier = $request->complain_supplier;
            $smsSettings->complain_footer_message = $request->complain_footer_message;
            $smsSettings->complain_followup_general = $request->complain_followup_general;
            $smsSettings->complain_followup_supplier = $request->complain_followup_supplier;
            $smsSettings->general_general = $request->general_general;
            $smsSettings->general_supplier = $request->general_supplier;
            $smsSettings->general_footer_message = $request->general_footer_message;
            $smsSettings->general_followup_general = $request->general_followup_general;
            $smsSettings->general_followup_supplier = $request->general_followup_supplier;
            $smsSettings->salebill_inward_general = $request->salebill_inward_general;
            $smsSettings->salebill_inward_supplier = $request->salebill_inward_supplier;
            $smsSettings->salebill_inward_footer_message = $request->salebill_inward_footer_message;
            $smsSettings->salebill_outward_followup_general = $request->salebill_outward_followup_general;
            $smsSettings->salebill_outward_followup_supplier = $request->salebill_outward_followup_supplier;
            $smsSettings->salebill_outward_followup_footer_message = $request->salebill_outward_followup_footer_message;
            $smsSettings->salebill_followup_general = $request->salebill_followup_general;
            $smsSettings->salebill_followup_supplier = $request->salebill_followup_supplier;
            $smsSettings->payment_general = $request->payment_general;
            $smsSettings->payment_supplier = $request->payment_supplier;
            $smsSettings->payment_footer_message = $request->payment_footer_message;
            $smsSettings->payment_outward_followup_general = $request->payment_outward_followup_general;
            $smsSettings->payment_outward_followup_supplier = $request->payment_outward_followup_supplier;
            $smsSettings->payment_outward_footer_message = $request->payment_outward_footer_message;
            $smsSettings->payment_followup_general = $request->payment_followup_general;
            $smsSettings->payment_followup_supplier = $request->payment_followup_supplier;
            $smsSettings->commission_general = $request->commission_general;
            $smsSettings->commission_supplier = $request->commission_supplier;
            $smsSettings->commission_footer_message = $request->commission_footer_message;
            $smsSettings->commission_followup_general = $request->commission_followup_general;
            $smsSettings->commission_followup_supplier = $request->commission_followup_supplier;
            $smsSettings->automated_payment_general = $request->automated_payment_general;
            $smsSettings->automated_payment_supplier = $request->automated_payment_supplier;
            $smsSettings->automated_payment_footer_message = $request->automated_payment_footer_message;
            $smsSettings->automated_commission_followup_general = $request->automated_commission_followup_general;
            $smsSettings->automated_commission_followup_supplier = $request->automated_commission_followup_supplier;
            $smsSettings->automated_commission_followup_footer_message = $request->automated_commission_followup_footer_message;
            $smsSettings->save();

        } else {
            $smsSettings = new SmsSettings;
            $smsSettings->employee_id = $id;
            $smsSettings->enquiry_general = $request->enquiry_general;
            $smsSettings->enquiry_supplier = $request->enquiry_supplier;
            $smsSettings->enquiry_footer_message = $request->enquiry_footer_message;
            $smsSettings->enquiry_followup_general = $request->enquiry_followup_general;
            $smsSettings->enquiry_followup_supplier = $request->enquiry_followup_supplier;
            $smsSettings->order_general = $request->order_general;
            $smsSettings->order_supplier = $request->order_supplier;
            $smsSettings->order_footer_message = $request->order_footer_message;
            $smsSettings->order_followup_general = $request->order_followup_general;
            $smsSettings->order_followup_supplier = $request->order_followup_supplier;
            $smsSettings->complain_general = $request->complain_general;
            $smsSettings->complain_supplier = $request->complain_supplier;
            $smsSettings->complain_footer_message = $request->complain_footer_message;
            $smsSettings->complain_followup_general = $request->complain_followup_general;
            $smsSettings->complain_followup_supplier = $request->complain_followup_supplier;
            $smsSettings->general_general = $request->general_general;
            $smsSettings->general_supplier = $request->general_supplier;
            $smsSettings->general_footer_message = $request->general_footer_message;
            $smsSettings->general_followup_general = $request->general_followup_general;
            $smsSettings->general_followup_supplier = $request->general_followup_supplier;
            $smsSettings->salebill_inward_general = $request->salebill_inward_general;
            $smsSettings->salebill_inward_supplier = $request->salebill_inward_supplier;
            $smsSettings->salebill_inward_footer_message = $request->salebill_inward_footer_message;
            $smsSettings->salebill_outward_followup_general = $request->salebill_outward_followup_general;
            $smsSettings->salebill_outward_followup_supplier = $request->salebill_outward_followup_supplier;
            $smsSettings->salebill_outward_followup_footer_message = $request->salebill_outward_followup_footer_message;
            $smsSettings->salebill_followup_general = $request->salebill_followup_general;
            $smsSettings->salebill_followup_supplier = $request->salebill_followup_supplier;
            $smsSettings->payment_general = $request->payment_general;
            $smsSettings->payment_supplier = $request->payment_supplier;
            $smsSettings->payment_footer_message = $request->payment_footer_message;
            $smsSettings->payment_outward_followup_general = $request->payment_outward_followup_general;
            $smsSettings->payment_outward_followup_supplier = $request->payment_outward_followup_supplier;
            $smsSettings->payment_outward_footer_message = $request->payment_outward_footer_message;
            $smsSettings->payment_followup_general = $request->payment_followup_general;
            $smsSettings->payment_followup_supplier = $request->payment_followup_supplier;
            $smsSettings->commission_general = $request->commission_general;
            $smsSettings->commission_supplier = $request->commission_supplier;
            $smsSettings->commission_footer_message = $request->commission_footer_message;
            $smsSettings->commission_followup_general = $request->commission_followup_general;
            $smsSettings->commission_followup_supplier = $request->commission_followup_supplier;
            $smsSettings->automated_payment_general = $request->automated_payment_general;
            $smsSettings->automated_payment_supplier = $request->automated_payment_supplier;
            $smsSettings->automated_payment_footer_message = $request->automated_payment_footer_message;
            $smsSettings->automated_commission_followup_general = $request->automated_commission_followup_general;
            $smsSettings->automated_commission_followup_supplier = $request->automated_commission_followup_supplier;
            $smsSettings->automated_commission_followup_footer_message = $request->automated_commission_followup_footer_message;
            $smsSettings->save();
        }

        $logs = new Logs;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Settings / SmsSettings / Edit';
        $logs->log_subject = 'SmsSettings - "'.$request->name.'" was updated from '.Session::get('user')->username.'.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }
}
