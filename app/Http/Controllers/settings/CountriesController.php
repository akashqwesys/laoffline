<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Employee;
use App\Models\Logs;
use App\Models\Settings\Country;
use Illuminate\Support\Facades\Session;

class CountriesController extends Controller
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
        $logs->log_path = 'Settings / Country / View';
        $logs->log_subject = 'Country view page visited.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();

        return view('settings.countries.country')->with('employees', $employees);
    }

    public function createCountries() {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        return view('settings.countries.createCountry')->with('employees', $employees);
    }

    public function listCountries() {
        $countries = Country::all();

        return $countries;
    }

    public function editCountries($id) {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        $employees['scope'] = 'edit';
        $employees['editedId'] = $id;

        return view('settings.countries.editCountry')->with('employees', $employees);
    }

    public function fetchCountries($id) {
        $countriesData = Country::where('id', $id)->first();
        $countriesData->is_delete = 1;
        $countriesData->save();

        return $countriesData;
    }

    public function deleteCountries($id){
        $countriesData = Country::where('id',$id)->first();        
        
        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Settings / Country / Delete';
        $logs->log_subject = 'Country - "'.$countriesData->name.'" was deleted.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }

    public function insertCountriesData(Request $request) {
        $this->validate($request, [
            'country_code' => 'required',
            'name' => 'required',
        ]);

        $countryLastId = Country::orderBy('id', 'DESC')->first('id');
        $countryId = !empty($countryLastId) ? $countryLastId->id + 1 : 1;

        $countries = new Country;
        $countries->id = $countryId;
        $countries->country_code = $request->country_code;
        $countries->name = $request->name;
        $countries->save();

        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Settings / Country / Add';
        $logs->log_subject = 'Country - "'.$request->name.'" was inserted from '.Session::get('user')->username.'.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }

    public function updateCountriesData(Request $request) {
        $this->validate($request, [
            'country_code' => 'required',
            'name' => 'required',
        ]);
        
        $id = $request->id;

        $countries = Country::where('id', $id)->first();
        $countries->country_code = $request->country_code;
        $countries->name = $request->name;
        $countries->save();

        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Settings / Country / Edit';
        $logs->log_subject = 'Country - "'.$request->name.'" was updated from '.Session::get('user')->username.'.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }
}
