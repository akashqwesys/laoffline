<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Logs;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Session;

class PermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();
        
        $employees['excelAccess'] = $user->excel_access;

        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'UserGroup / View';
        $logs->log_subject = 'User Group view page visited.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();

        return view('settings.permissions.permission')->with('employees', $employees);
    }

    public function createPermission() {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        return view('settings.permissions.createpermission')->with('employees', $employees);
    }

    public function listPermission() {
        $permission = Permission::get();
        return $permission;
    }

    public function editPermission($id) {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        $employees['scope'] = 'edit';
        $employees['editedId'] = $id;

        return view('settings.permissions.editPermission')->with('employees', $employees);
    }

    public function fetchPermission($id) {
        $permission = Permission::where('id', $id)->first();
        
        return $permission;
    }

    public function deletePermission($id){
        $user = Session::get('user');
        $permission = Permission::where('id', $id)->first();
        $permission->is_delete = 1;
        $permission->save();

        $user->revokePermissionTo($permission->name);

        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = $user->employee_id;
        $logs->log_path = 'Company Type / Delete';
        $logs->log_subject = 'Company Type - '.$permission->company_name.' was deleted by"'.$user->username.'".';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }

    public function insertPermissionData(Request $request) {
        $this->validate($request, [
            'name' => 'required',
        ]);
        
        $accessPermissionLastId = Permission::orderBy('id', 'DESC')->first('id');
        $accessPermissionId = !empty($accessPermissionLastId) ? $accessPermissionLastId->id + 1 : 1;

        $permission = new Permission;
        $permission->id = $accessPermissionId;
        $permission->name = 'access-'.strtolower(str_replace(' ', '-', $request->name));
        $permission->save();
        
        $modifyPermissionLastId = Permission::orderBy('id', 'DESC')->first('id');
        $modifyPermissionId = !empty($modifyPermissionLastId) ? $modifyPermissionLastId->id + 1 : 1;

        $permission = new Permission;
        $permission->id = $modifyPermissionId;
        $permission->name = 'modify-'.strtolower(str_replace(' ', '-', $request->name));
        $permission->save();

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

    public function updatePermissionData(Request $request) {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $permission = Permission::where('id', $request->id)->first();
        if ($request->type == 'Access') {
            $permission->name = 'access-'.strtolower(str_replace(' ', '-', $request->name));

        } elseif ($request->type == 'Modify') {
            $permission->name = 'modify-'.strtolower(str_replace(' ', '-', $request->name));
        }
        $permission->save();

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
