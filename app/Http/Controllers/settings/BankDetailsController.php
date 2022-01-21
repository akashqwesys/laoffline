<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Employee;
use App\Models\Logs;
use App\Models\Settings\BankDetails;
use Illuminate\Support\Facades\Session;

class BankDetailsController extends Controller
{
    use HasRoles;    

    public function index(Request $request) {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        $logs = new Logs;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Settings / Bank Details / View';
        $logs->log_subject = 'Bank Details view page visited.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();

        return view('settings.bankDetails.bankDetail')->with('employees', $employees);
    }

    public function createBankDetails() {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        return view('settings.bankDetails.createBankDetail')->with('employees', $employees);
    }

    public function listBankDetails() {
        $bankDetails = BankDetails::all();

        return $bankDetails;
    }

    public function editBankDetails($id) {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        $employees['scope'] = 'edit';
        $employees['editedId'] = $id;

        return view('settings.bankDetails.editBankDetail')->with('employees', $employees);
    }

    public function fetchBankDetails($id) {        
        $bankDetailsData = BankDetails::where('id', $id)->first();

        return $bankDetailsData;
    }

    public function deleteBankDetails($id){
        $bankDetailsData = BankDetails::where('id',$id)->first();        
        
        $logs = new Logs;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Settings / Bank Details / Delete';
        $logs->log_subject = 'Bank Details - "'.$bankDetailsData->name.'" was deleted.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();

        $bankDetailsData->delete();
    }

    public function insertBankDetailsData(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'sort_order' => 'required',
        ]);

        $bankDetails = new BankDetails;
        $bankDetails->name = $request->name;
        $bankDetails->sort_order = $request->sort_order;
        $bankDetails->save();

        $logs = new Logs;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Settings / Bank Details / Add';
        $logs->log_subject = 'Bank Details - "'.$request->category_name.'" was inserted from '.Session::get('user')->username.'.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }

    public function updateBankDetailsData(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'sort_order' => 'required',
        ]);
        
        $id = $request->id;

        $bankDetails = BankDetails::where('id', $id)->first();
        $bankDetails->name = $request->name;
        $bankDetails->sort_order = $request->sort_order;
        $bankDetails->save();

        $logs = new Logs;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Settings / Bank Details / Edit';
        $logs->log_subject = 'Bank Details - "'.$request->category_name.'" was updated from '.Session::get('user')->username.'.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }
}
