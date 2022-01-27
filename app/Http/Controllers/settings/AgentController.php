<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Employee;
use App\Models\Logs;
use App\Models\Settings\Agent;
use Illuminate\Support\Facades\Session;

class AgentController extends Controller
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
        $logs->log_path = 'Settings / Agent / View';
        $logs->log_subject = 'Agent view page visited.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();

        return view('settings.agents.agent')->with('employees', $employees);
    }

    public function createAgent() {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        return view('settings.agents.createAgent')->with('employees', $employees);
    }

    public function listAgent() {
        $agent = Agent::all();

        return $agent;
    }

    public function editAgent($id) {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        $employees['scope'] = 'edit';
        $employees['editedId'] = $id;

        return view('settings.agents.editAgent')->with('employees', $employees);
    }

    public function fetchAgent($id) {        
        $agentData = Agent::where('id', $id)->first();

        return $agentData;
    }

    public function deleteAgent($id){
        $agentData = Agent::where('id',$id)->first();        
        
        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Settings / Agent / Delete';
        $logs->log_subject = 'Agent - "'.$agentData->name.'" was deleted.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();

        $agentData->delete();
    }

    public function insertAgentData(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'pan_no' => 'required',
            'gst_no' => 'required',
            'default' => 'required',
        ]);

        $agentLastId = Agent::orderBy('id', 'DESC')->first('id');
        $agentId = !empty($agentLastId) ? $agentLastId->id + 1 : 1;

        $agent = new Agent;
        $agent->id = $agentId;
        $agent->name = $request->name;
        $agent->pan_no = $request->pan_no;
        $agent->gst_no = $request->gst_no;
        $agent->default = $request->default;
        $agent->save();

        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Settings / Agent / Add';
        $logs->log_subject = 'Agent - "'.$request->name.'" was inserted from '.Session::get('user')->username.'.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }

    public function updateAgentData(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'pan_no' => 'required',
            'gst_no' => 'required',
            'default' => 'required',
        ]);
        
        $id = $request->id;

        $agent = Agent::where('id', $id)->first();
        $agent->name = $request->name;
        $agent->pan_no = $request->pan_no;
        $agent->gst_no = $request->gst_no;
        $agent->default = $request->default;
        $agent->save();

        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Settings / Agent / Edit';
        $logs->log_subject = 'Agent - "'.$request->name.'" was updated from '.Session::get('user')->username.'.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }
}
