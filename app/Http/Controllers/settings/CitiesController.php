<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Employee;
use App\Models\Logs;
use App\Models\Settings\Cities;
use App\Models\Settings\Country;
use App\Models\Settings\State;
use Illuminate\Support\Facades\Session;

class CitiesController extends Controller
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
        $logs->log_path = 'Settings / City / View';
        $logs->log_subject = 'City view page visited.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();

        return view('settings.cities.city')->with('employees', $employees);
    }

    public function createCities() {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        return view('settings.cities.createCity')->with('employees', $employees);
    }

    public function listCountries() {
        $countries = Country::all();

        return $countries;
    }

    public function listState() {
        $state = State::all();

        return $state;
    }

    public function listStateByCountryId($id) {
        $state = State::where('country_id', $id)->get();

        return $state;
    }

    public function listCityByStateId($id) {
        $city = Cities::where('state', $id)->get();

        return $city;
    }

    public function listCities() {
        $city = Cities::all();

        return $city;
    }

    public function editCities($id) {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        $employees['scope'] = 'edit';
        $employees['editedId'] = $id;

        return view('settings.cities.editCity')->with('employees', $employees);
    }

    public function fetchCities($id) {
        $citiesData = Cities::where('id', $id)->first();

        return $citiesData;
    }

    public function deleteCities($id){
        $citiesData = Cities::where('id',$id)->first();        
        
        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Settings / Cities / Delete';
        $logs->log_subject = 'Cities - "'.$citiesData->name.'" was deleted.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();

        $citiesData->delete();
    }

    public function insertCitiesData(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'std_code' => 'required',
            'country' => 'required',
            'state' => 'required',
        ]);

        $citiesLastId = Cities::orderBy('id', 'DESC')->first('id');
        $citiesId = !empty($citiesLastId) ? $citiesLastId->id + 1 : 1;

        $cities = new Cities;
        $cities->id = $citiesId;
        $cities->name = $request->name;
        $cities->std_code = $request->std_code;
        $cities->country = $request->country;
        $cities->state = $request->state;
        $cities->save();

        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Settings / Cities / Add';
        $logs->log_subject = 'Cities - "'.$request->name.'" was inserted from '.Session::get('user')->username.'.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }

    public function updateCitiesData(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'std_code' => 'required',
            'country' => 'required',
            'state' => 'required',
        ]);
        
        $id = $request->id;

        $cities = Cities::where('id', $id)->first();
        $cities->name = $request->name;
        $cities->std_code = $request->std_code;
        $cities->country = $request->country;
        $cities->state = $request->state;
        $cities->save();

        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Settings / Cities / Edit';
        $logs->log_subject = 'Cities - "'.$request->name.'" was updated from '.Session::get('user')->username.'.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }
}
