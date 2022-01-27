<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Employee;
use App\Models\Logs;
use App\Models\Settings\TransportDetails;
use App\Models\Settings\TransportMultipleAddressDetails;
use Illuminate\Support\Facades\Session;

class TransportDetailsController extends Controller
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
        $logs->log_path = 'Settings / TransportDetails / View';
        $logs->log_subject = 'TransportDetails view page visited.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();

        return view('settings.transportDetails.transportDetail')->with('employees', $employees);
    }

    public function createTransportDetails() {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        return view('settings.transportDetails.createTransportDetail')->with('employees', $employees);
    }

    public function listTransportDetails() {
        $transportDetails = TransportDetails::all();

        return $transportDetails;
    }

    public function editTransportDetails($id) {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        $employees['scope'] = 'edit';
        $employees['editedId'] = $id;

        return view('settings.transportDetails.editTransportDetail')->with('employees', $employees);
    }

    public function fetchTransportDetails($id) {        
        $transportDetailsData = TransportDetails::where('id', $id)->first();
        $transportMultipleAddressDetails = TransportMultipleAddressDetails::where('transport_details', $id)->get();
        $transportDetailsData['multiple_address'] = $transportMultipleAddressDetails;

        return $transportDetailsData;
    }

    public function deleteTransportDetails($id){
        $transportDetailsData = TransportDetails::where('id',$id)->first();
        
        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Settings / TransportDetails / Delete';
        $logs->log_subject = 'TransportDetails - "'.$transportDetailsData->name.'" was deleted.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();

        TransportMultipleAddressDetails::where('transport_details',$id)->delete();
        $transportDetailsData->delete();
    }

    public function insertTransportDetailsData(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'gstin' => 'required',
        ]);

        
        $transportDetailsLastId = TransportDetails::orderBy('id', 'DESC')->first('id');
        $transportDetailsId = !empty($transportDetailsLastId) ? $transportDetailsLastId->id + 1 : 1;

        $transportDetails = new TransportDetails;
        $transportDetails->id = $transportDetailsId;
        $transportDetails->name = $request->name;
        $transportDetails->gstin = $request->gstin;
        $transportDetails->save();
        
        if($request->multiple_address) {
            $multipleAddresses = $request->multiple_address;
            foreach($multipleAddresses as $multipleAddress) {
                $transportMultipleAddressDetailsLastId = TransportMultipleAddressDetails::orderBy('id', 'DESC')->first('id');
                $transportMultipleAddressDetailsId = !empty($transportMultipleAddressDetailsLastId) ? $transportMultipleAddressDetailsLastId->id + 1 : 1;
        
                $transportMultipleAddressDetails = new TransportMultipleAddressDetails;
                $transportMultipleAddressDetails->id = $transportMultipleAddressDetailsId;
                $transportMultipleAddressDetails->transport_details = $transportDetails->id;
                $transportMultipleAddressDetails->contact_person_name = $multipleAddress['contact_person_name'];
                $transportMultipleAddressDetails->contact_person_address = $multipleAddress['contact_person_address'];
                $transportMultipleAddressDetails->contact_person_office_no = $multipleAddress['contact_person_office_no'];
                $transportMultipleAddressDetails->contact_person_email = $multipleAddress['contact_person_email'];
                $transportMultipleAddressDetails->save();
            }
        }

        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Settings / TransportDetails / Add';
        $logs->log_subject = 'TransportDetails - "'.$request->name.'" was inserted from '.Session::get('user')->username.'.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }

    public function updateTransportDetailsData(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'gstin' => 'required',
        ]);
        
        $id = $request->id;
        $multipleAddresses = $request->multiple_address;

        $transportDetails = TransportDetails::where('id', $id)->first();
        $transportDetails->name = $request->name;
        $transportDetails->gstin = $request->gstin;
        $transportDetails->save();

        TransportMultipleAddressDetails::where('transport_details',$id)->delete();
        foreach($multipleAddresses as $multipleAddress) {
            $transportMultipleAddressDetails = new TransportMultipleAddressDetails;
            $transportMultipleAddressDetails->transport_details = $transportDetails->id;
            $transportMultipleAddressDetails->contact_person_name = $multipleAddress['contact_person_name'];
            $transportMultipleAddressDetails->contact_person_address = $multipleAddress['contact_person_address'];
            $transportMultipleAddressDetails->contact_person_office_no = $multipleAddress['contact_person_office_no'];
            $transportMultipleAddressDetails->contact_person_email = $multipleAddress['contact_person_email'];
            $transportMultipleAddressDetails->save();
        }

        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Settings / TransportDetails / Edit';
        $logs->log_subject = 'TransportDetails - "'.$request->name.'" was updated from '.Session::get('user')->username.'.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }
}
