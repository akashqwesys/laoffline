<?php

namespace App\Http\Controllers\databank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Employee;
use App\Models\CompanyCategory;
use App\Models\Logs;
use Illuminate\Support\Facades\Session;

class CompanyCategoryController extends Controller
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
        $logs->log_path = 'CompanyCategory / View';
        $logs->log_subject = 'Company Category view page visited.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();

        return view('databank.companyCategories.companyCategory')->with('employees', $employees);
    }

    public function createCompanyCategory() {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        return view('databank.companyCategories.createCompanyCategory')->with('employees', $employees);
    }

    public function listCompanyCategory() {
        $companyCategory = CompanyCategory::where('is_delete', 0)->get();

        return $companyCategory;
    }

    public function editCompanyCategory($id) {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        $employees['scope'] = 'edit';
        $employees['editedId'] = $id;

        return view('databank.companyCategories.editCompanyCategory')->with('employees', $employees);
    }

    public function fetchCompanyCategory($id) {        
        $companyCategoriesData = CompanyCategory::where('id', $id)->first();

        return $companyCategoriesData;
    }

    public function deleteCompanyCategory($id){
        $companyCategoryData = CompanyCategory::where('id',$id)->first();
        $companyCategoryData->is_delete = 1;
        $companyCategoryData->save();
        
        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Company Category / Delete';
        $logs->log_subject = 'Company Category - "'.$companyCategoryData->category_name.'" was deleted.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }

    public function insertCompanyCategoryData(Request $request) {
        $this->validate($request, [
            'category_name' => 'required',
        ]);

        $comapnyCategoryLastId = CompanyCategory::orderBy('id', 'DESC')->first('id');
        $companyCategoryId = !empty($comapnyCategoryLastId) ? $comapnyCategoryLastId->id + 1 : 1;

        $companyCategory = new CompanyCategory;
        $companyCategory->id = $companyCategoryId;
        $companyCategory->category_name = $request->category_name;
        $companyCategory->sort_order = $request->sort_order;
        $companyCategory->save();

        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Company category / Add';
        $logs->log_subject = 'Company category - "'.$request->category_name.'" was inserted from '.Session::get('user')->username.'.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }

    public function updateCompanyCategoryData(Request $request) {
        $this->validate($request, [
            'category_name' => 'required',
        ]);
        
        $id = $request->id;

        $companyCategory = CompanyCategory::where('id', $id)->first();
        $companyCategory->category_name = $request->category_name;
        $companyCategory->sort_order = $request->sort_order;
        $companyCategory->save();

        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Company category / Edit';
        $logs->log_subject = 'Company category - "'.$request->category_name.'" was updated from '.Session::get('user')->username.'.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }
}
