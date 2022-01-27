<?php

namespace App\Http\Controllers\databank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
use App\Models\UserGroup;
use App\Models\Employee;
use App\Models\User;
use App\Models\Logs;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Session;

class EmployeesController extends Controller
{
    use HasRoles;

    public function index(Request $request) {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Employe / View';
        $logs->log_subject = 'Employee view page visited.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();

        return view('databank.employees.employee')->with('employees', $employees);
    }

    public function createEmployee() {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        return view('databank.employees.createEmployee')->with('employees', $employees);
    }

    public function getPermissions() {
        $permissions = Permission::all();

        return $permissions;
    }

    public function listEmployee() {
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->get();

        return $employees;
    }

    public function editEmployee($id) {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        $employees['scope'] = 'edit';
        $employees['editedId'] = $id;

        return view('databank.employees.editEmployee')->with('employees', $employees);
    }

    public function fetchEmployee($id) {        
        $employeeData = Employee::join('users', 'employees.id', '=', 'users.employee_id')->where('employees.id', $id)->first(['users.*', 'employees.*', 'employees.id as employee_id']);
        $employeeData['user_group'] = UserGroup::where('id', $employeeData->user_group)->first();

        return $employeeData;
    }

    public function deleteEmployee($id){
        $employeeData = Employee::where('id',$id)->first();        
        $user = User::where('employee_id',$id)->first();
        
        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Employe / Delete';
        $logs->log_subject = 'Employee - '.$user->username.' was deleted.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();

        $employeeData->delete();
        $user->delete();
    }

    public function insertEmployeeData(Request $request) {
        $profileImage = '';
        $idProofName = '';
        $referencePassPicName = '';

        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'email_id' => 'required|email',
            'mobile' => 'required',
            'address' => 'required',
            'user_group' => 'required',
            'excel_access' => 'required',
            'username' => 'required',
            'password' => 'required|confirmed',
        ]);

        if ($image = $request->file('profile_pic')) {
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move(public_path('upload/profilePic'), $profileImage);
        }

        if ($image = $request->file('id_proof')) {
            $idProofName = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move(public_path('upload/idProof'), $idProofName);
        }

        if ($image = $request->file('ref_pass_pic')) {
            $referencePassPicName = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move(public_path('upload/referencePassPic'), $referencePassPicName);
        }

        $employeeLastId = Employee::orderBy('id', 'DESC')->first('id');
        $employeeId = !empty($employeeLastId) ? $employeeLastId->id + 1 : 1;

        $employee = new Employee;
        $employee->id = $employeeId;
        $employee->firstname = $request->firstname;
        $employee->middlename = $request->middlename;
        $employee->lastname = $request->lastname;
        $employee->profile_pic = $profileImage;
        $employee->email_id = $request->email_id;
        $employee->mobile = $request->mobile;
        $employee->address = $request->address;
        $employee->user_group = $request->user_group['id'];
        $employee->excel_access = $request->excel_access;
        $employee->id_proof = $idProofName;
        $employee->ref_full_name = $request->ref_full_name;
        $employee->ref_pass_pic = $referencePassPicName;
        $employee->ref_mobile = $request->ref_mobile;
        $employee->ref_address = $request->ref_address;
        $employee->save();

        $userLastId = User::orderBy('id', 'DESC')->first('id');
        $userId = !empty($userLastId) ? $userLastId->id + 1 : 1;

        $user = new User;
        $user->id = $userId;
        $user->employee_id = $employeeId;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->is_active = 1;
        $user->save();

        $userGroupData = UserGroup::where('id', $request->user_group['id'])->first();

        $role = Role::where('id', $userGroupData['roles_id'])->first();

        $user->assignRole($role);
        
        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Employe / Add';
        $logs->log_subject = 'Employee - "'.$user->username.'" was inserted from '.Session::get('user')->username.'.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }

    public function updateEmployeeData(Request $request) {
        $profileImage = '';
        $idProofName = '';
        $referencePassPicName = '';

        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'email_id' => 'required|email',
            'mobile' => 'required',
            'address' => 'required',
            'user_group' => 'required',
            'excel_access' => 'required',
            'username' => 'required',
        ]);
        
        $id = $request->id;        

        if ($image = $request->file('profile_pic')) {
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move(public_path('upload/profilePic'), $profileImage);
        }

        if ($image = $request->file('id_proof')) {
            $idProofName = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move(public_path('upload/idProof'), $idProofName);
        }

        if ($image = $request->file('ref_pass_pic')) {
            $referencePassPicName = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move(public_path('upload/referencePassPic'), $referencePassPicName);
        }

        $employee = Employee::where('id', $id)->first();
        $employee->firstname = $request->firstname ? $request->firstname : '';
        $employee->middlename = $request->middlename ? $request->middlename : ''; 
        $employee->lastname = $request->lastname ? $request->lastname : '';
        $employee->profile_pic = $profileImage;
        $employee->email_id = $request->email_id ? $request->email_id : '';
        $employee->mobile = $request->mobile ? $request->mobile : '';
        $employee->address = $request->address ? $request->address : '';
        $employee->user_group = $request->user_group['id'] ? $request->user_group['id'] : '';
        $employee->excel_access = $request->excel_access ? $request->excel_access : 0;
        $employee->id_proof = $idProofName;
        $employee->ref_full_name = $request->ref_full_name ? $request->ref_full_name : '';
        $employee->ref_pass_pic = $referencePassPicName;
        $employee->ref_mobile = $request->ref_mobile ? $request->ref_mobile : '';
        $employee->ref_address = $request->ref_address ? $request->ref_address : '';
        $employee->save();

        $user = User::where('employee_id', $id)->first();
        $user->username = $request->username;
        $user->is_active = $request->is_active;
        $user->save();

        $userGroupData = UserGroup::where('id', $request->user_group['id'])->first();
        
        $role = Role::where('id', $userGroupData['roles_id'])->first();

        $user->assignRole($role);
        
        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Employe / Edit';
        $logs->log_subject = 'Employee - "'.$user->username.'" was updated from '.Session::get('user')->username.'.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }
}
