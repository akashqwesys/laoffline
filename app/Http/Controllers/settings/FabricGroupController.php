<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Employee;
use App\Models\Logs;
use App\Models\Settings\ProductFabricGroup;
use Illuminate\Support\Facades\Session;

class FabricGroupController extends Controller
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
        $logs->log_path = 'Settings / Fabric Group / View';
        $logs->log_subject = 'Fabric Group view page visited.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();

        return view('settings.fabricGroups.fabricGroup')->with('employees', $employees);
    }

    public function createFabricGroup() {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        return view('settings.fabricGroups.createFabricGroup')->with('employees', $employees);
    }

    public function listFabricGroup() {
        $fabricGroup = ProductFabricGroup::all();

        return $fabricGroup;
    }

    public function editFabricGroup($id) {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        $employees['scope'] = 'edit';
        $employees['editedId'] = $id;

        return view('settings.fabricGroups.editFabricGroup')->with('employees', $employees);
    }

    public function fetchFabricGroup($id) {
        $fabricGroupData = ProductFabricGroup::where('id', $id)->first();

        return $fabricGroupData;
    }

    public function deleteFabricGroup($id){
        $fabricGroupData = ProductFabricGroup::where('id',$id)->first();        
        
        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Settings / Fabric Group / Delete';
        $logs->log_subject = 'Fabric Group - "'.$fabricGroupData->name.'" was deleted.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();

        $fabricGroupData->delete();
    }

    public function insertFabricGroupData(Request $request) {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $fabricGroupsLastId = ProductFabricGroup::orderBy('id', 'DESC')->first('id');
        $fabricGroupsId = !empty($fabricGroupsLastId) ? $fabricGroupsLastId->id + 1 : 1;

        $fabricGroups = new ProductFabricGroup;
        $fabricGroups->id = $fabricGroupsId;
        $fabricGroups->name = $request->name;
        $fabricGroups->save();

        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Settings / Fabric Group / Add';
        $logs->log_subject = 'Fabric Group - "'.$request->name.'" was inserted from '.Session::get('user')->username.'.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }

    public function updateFabricGroupData(Request $request) {
        $this->validate($request, [
            'name' => 'required',
        ]);
        
        $id = $request->id;

        $fabricGroups = ProductFabricGroup::where('id', $id)->first();
        $fabricGroups->name = $request->name;
        $fabricGroups->save();

        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Settings / Fabric Group / Edit';
        $logs->log_subject = 'Fabric Group - "'.$request->name.'" was updated from '.Session::get('user')->username.'.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }
}
