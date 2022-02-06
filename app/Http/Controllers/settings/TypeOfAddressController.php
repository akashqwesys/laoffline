<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Employee;
use App\Models\Logs;
use App\Models\Settings\TypeOfAddress;
use Illuminate\Support\Facades\Session;

class TypeOfAddressController extends Controller
{
    use HasRoles;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();
        
        $employees['excelAccess'] = $user->excel_access;

        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Settings / TypeOfAddress / View';
        $logs->log_subject = 'TypeOfAddress view page visited.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();

        return view('settings.typeOfAddresses.typeOfAddress')->with('employees', $employees);
    }

    public function createTypeOfAddress() {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        return view('settings.typeOfAddresses.createTypeOfAddress')->with('employees', $employees);
    }

    public function listTypeOfAddress() {
        $typeOfAddress = TypeOfAddress::all();

        return $typeOfAddress;
    }

    public function editTypeOfAddress($id) {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        $employees['scope'] = 'edit';
        $employees['editedId'] = $id;

        return view('settings.typeOfAddresses.editTypeOfAddress')->with('employees', $employees);
    }

    public function fetchTypeOfAddress($id) {        
        $typeOfAddressData = TypeOfAddress::where('id', $id)->first();

        return $typeOfAddressData;
    }

    public function deleteTypeOfAddress($id){
        $typeOfAddressData = TypeOfAddress::where('id',$id)->first();
        $typeOfAddressData->is_delete = 1;
        $typeOfAddressData->save();
        
        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Settings / TypeOfAddress / Delete';
        $logs->log_subject = 'TypeOfAddress - "'.$typeOfAddressData->name.'" was deleted.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }

    public function insertTypeOfAddressData(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'sort_order' => 'required'
        ]);

        $typeOfAddressLastId = TypeOfAddress::orderBy('id', 'DESC')->first('id');
        $typeOfAddressId = !empty($typeOfAddressLastId) ? $typeOfAddressLastId->id + 1 : 1;

        $typeOfAddress = new TypeOfAddress;
        $typeOfAddress->id = $typeOfAddressId;
        $typeOfAddress->name = $request->name;
        $typeOfAddress->sort_order = $request->sort_order;
        $typeOfAddress->save();

        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Settings / TypeOfAddress / Add';
        $logs->log_subject = 'TypeOfAddress - "'.$request->name.'" was inserted from '.Session::get('user')->username.'.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }

    public function updateTypeOfAddressData(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'sort_order' => 'required'
        ]);
        
        $id = $request->id;

        $typeOfAddress = TypeOfAddress::where('id', $id)->first();
        $typeOfAddress->name = $request->name;
        $typeOfAddress->sort_order = $request->sort_order;
        $typeOfAddress->save();

        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Settings / TypeOfAddress / Edit';
        $logs->log_subject = 'TypeOfAddress - "'.$request->name.'" was updated from '.Session::get('user')->username.'.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }
}
