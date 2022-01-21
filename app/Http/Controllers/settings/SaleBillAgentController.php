<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Employee;
use App\Models\Logs;
use App\Models\Settings\SaleBillAgent;
use Illuminate\Support\Facades\Session;

class SaleBillAgentController extends Controller
{
    use HasRoles;    

    public function index(Request $request) {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        $logs = new Logs;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Settings / Sale Bill Agent / View';
        $logs->log_subject = 'Sale Bill Agent view page visited.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();

        return view('settings.saleBillAgents.saleBillAgent')->with('employees', $employees);
    }

    public function createSaleBillAgent() {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        return view('settings.saleBillAgents.createSaleBillAgent')->with('employees', $employees);
    }

    public function listSaleBillAgent() {
        $saleBillAgent = SaleBillAgent::all();

        return $saleBillAgent;
    }

    public function editSaleBillAgent($id) {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        $employees['scope'] = 'edit';
        $employees['editedId'] = $id;

        return view('settings.saleBillAgents.editSaleBillAgent')->with('employees', $employees);
    }

    public function fetchSaleBillAgent($id) {        
        $saleBillAgentData = SaleBillAgent::where('id', $id)->first();

        return $saleBillAgentData;
    }

    public function deleteSaleBillAgent($id){
        $saleBillAgentData = SaleBillAgent::where('id',$id)->first();        
        
        $logs = new Logs;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Settings / SaleBillAgent / Delete';
        $logs->log_subject = 'SaleBillAgent - "'.$saleBillAgentData->name.'" was deleted.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();

        $saleBillAgentData->delete();
    }

    public function insertSaleBillAgentData(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'default' => 'required',
        ]);

        $saleBillAgent = new SaleBillAgent;
        $saleBillAgent->name = $request->name;
        $saleBillAgent->default = $request->default;
        $saleBillAgent->save();

        $logs = new Logs;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Settings / SaleBillAgent / Add';
        $logs->log_subject = 'SaleBillAgent - "'.$request->name.'" was inserted from '.Session::get('user')->username.'.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }

    public function updateSaleBillAgentData(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'default' => 'required',
        ]);
        
        $id = $request->id;

        $saleBillAgent = SaleBillAgent::where('id', $id)->first();
        $saleBillAgent->name = $request->name;
        $saleBillAgent->default = $request->default;
        $saleBillAgent->save();

        $logs = new Logs;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Settings / SaleBillAgent / Edit';
        $logs->log_subject = 'SaleBillAgent - "'.$request->name.'" was updated from '.Session::get('user')->username.'.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }
}
