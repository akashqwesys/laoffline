<?php

namespace App\Http\Controllers\databank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
use App\Models\UserGroup;
use App\Models\Employee;
use App\Models\Logs;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Session;

class UserGroupController extends Controller
{
    use HasRoles;

    public function index() {
        $user = Session::get('user');

        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        $logs = new Logs;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'UserGroup / View';
        $logs->log_subject = 'User Group view page visited.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();

        return view('databank.userGroups.userGroup')->with('employees', $employees);
    }

    public function createUserGroup() {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        return view('databank.userGroups.createUserGroup')->with('employees', $employees);
    }

    public function getPermissions() {
        $permissions = Permission::all();

        return $permissions;
    }

    public function listUserGroup() {
        $userGroups = UserGroup::all();

        return $userGroups;
    }

    public function editUserGroup($id) {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        $employees['scope'] = 'edit';
        $employees['editedId'] = $id;

        return view('databank.userGroups.editUserGroup')->with('employees', $employees);
    }

    public function fetchUserGroup($id) { 
        $userGroupData = UserGroup::where('id', $id)->first();

        return $userGroupData;
    }

    public function deleteUserGroup($id){
        $userGroupData = UserGroup::where('id', $id)->first();
        
        $logs = new Logs;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Usergroup / Delete';
        $logs->log_subject = 'Usergroup - '.$userGroupData->name.' was deleted.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
        
        $role = Role::where('name', $userGroupData['name'])->first();
        
        $userGroupData->delete();
        $role->delete();
    }

    public function insertUserGroupData(Request $request) {

        $this->validate($request, [ 
            'name' => 'required',
            'access_permission' => 'required',
            'modify_permission' => 'required',
        ]);

        $permissions = array_merge($request->access_permission,$request->modify_permission);

        $role = Role::create(['name' => $request->name]);        
        $role->syncPermissions($permissions);

        $userGroup = new UserGroup;
        $userGroup->name = $request->name;
        $userGroup->roles_id = $role->id;
        $userGroup->access_permission = json_encode($request->access_permission);
        $userGroup->modify_permission = json_encode($request->modify_permission);
        $userGroup->save();
        
        $logs = new Logs;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Usergroup / Add';
        $logs->log_subject = 'Usergroup - "'.$userGroup->name.'" was inserted from '.Session::get('user')->username.'.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }

    public function updateUserGroupData(Request $request) {
        $this->validate($request, [ 
            'name' => 'required',
            'access_permission' => 'required',
            'modify_permission' => 'required',
        ]);
        
        $id = $request->id;        
        
        $userGroup = UserGroup::where('id', $id)->first();
        $userGroup->name = $request->name;
        $userGroup->access_permission = json_encode($request->access_permission);
        $userGroup->modify_permission = json_encode($request->modify_permission);
        $userGroup->save();

        $role = Role::where('id', $userGroup->roles_id)->first();
        $role->name = $request->name;
        $role->save();

        $permissions = array_merge($request->access_permission,$request->modify_permission);
        $role->syncPermissions($permissions);
        
        $logs = new Logs;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Usergroup / Update';
        $logs->log_subject = 'Usergroup - "'.$userGroup->name.'" was updated from '.Session::get('user')->username.'.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }
}
