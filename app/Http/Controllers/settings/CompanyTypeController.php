<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Logs;
use App\Models\CompanyType;
use Illuminate\Support\Facades\Session;

class CompanyTypeController extends Controller
{
    public function index() {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'UserGroup / View';
        $logs->log_subject = 'User Group view page visited.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();

        return view('settings.companyTypes.companyType')->with('employees', $employees);
    }

    public function createCompanyType() {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        return view('settings.companyTypes.createCompanyType')->with('employees', $employees);
    }

    public function listCompanyType() {
        $companyType = CompanyType::all();

        return $companyType;
    }

    public function editCompanyType($id) {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        $employees['scope'] = 'edit';
        $employees['editedId'] = $id;

        return view('settings.companyTypes.editCompanyType')->with('employees', $employees);
    }

    public function fetchCompanyType($id) {
        $companyType = CompanyType::where('id', $id)->first();
        
        return $companyType;
    }

    public function deleteCompanyType($id){
        $companyType = CompanyType::where('id', $id)->first();

        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Company Type / Delete';
        $logs->log_subject = 'Company Type - '.$companyType->company_name.' was deleted by"'.Session::get('user')->username.'".';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();

        $companyType->delete();
    }

    public function insertCompanyTypeData(Request $request) {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $companyTypeLastId = CompanyType::orderBy('id', 'DESC')->first('id');
        $companyTypeId = !empty($companyTypeLastId) ? $companyTypeLastId->id + 1 : 1;

        $companyType = new CompanyType;
        $companyType->id = $companyTypeId;
        $companyType->name = $request->name;
        $companyType->save();

        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Company Type / Add';
        $logs->log_subject = 'Company Type - "'.$request->name.'" was inserted from '.Session::get('user')->username.'.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }

    public function updateCompanyTypeData(Request $request) {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $companyType = CompanyType::where('id', $request->id)->first();
        $companyType->name = $request->name;
        $companyType->save();

        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Company / Edit';
        $logs->log_subject = 'Company - "'.$request->name.'" was updated from '.Session::get('user')->username.'.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }
}
