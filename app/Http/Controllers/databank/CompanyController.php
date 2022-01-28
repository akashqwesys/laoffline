<?php

namespace App\Http\Controllers\databank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\CompanyCategory;
use App\Models\Logs;
use App\Models\Company\Company;
use App\Models\Company\CompanyAddress;
use App\Models\Company\CompanyAddressOwner;
use App\Models\Company\CompanyBankDetails;
use App\Models\Company\CompanyContactDetails;
use App\Models\Company\CompanyEmails;
use App\Models\Company\CompanyPackagingDetails;
use App\Models\Company\CompanyReferences;
use App\Models\Company\CompanySwotDetails;
use Illuminate\Support\Facades\Session;
use Carbon;

class CompanyController extends Controller
{
    public function index() {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'UserGroup / View';
        $logs->log_subject = 'User Group view page visited.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();

        return view('databank.companies.company')->with('employees', $employees);
    }

    public function createCompany() {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        return view('databank.companies.createCompany')->with('employees', $employees);
    }

    public function listCompany() {
        $company = Company::all();

        foreach($company as $cmp) {
            if($cmp->company_type == 1) {
                $cmp['company_type'] = 'General';
            } elseif($cmp->company_type == 2) {
                $cmp['company_type'] = 'Customer';
            } elseif($cmp->company_type == 3) {
                $cmp['company_type'] = 'Supplier';
            }

            if(!empty($cmp->company_category)) {
                if(is_array(json_decode($cmp->company_category))) {
                    $companyName = [];
                    $companyArr = json_decode($cmp->company_category);
        
                    foreach($companyArr as $key => $c) {
                        $companyCat = CompanyCategory::where('id', $c)->first('category_name');
                        $companyName[$key] = $companyCat->category_name;
                    }

                } else {
                    $companyCat = CompanyCategory::where('id', $cmp->company_category)->first('category_name');
                    $companyName = $companyCat->category_name;
                }
                $cmp['company_category'] = is_array($companyName) ? implode(", ", $companyName) : $companyName;
            } else {
                $cmp['company_category'] = '';
            }
        }

        return $company;
    }

    public function listEssentialCompany() {
        $company = Company::join('company_addresses', 'companies.id', '=', 'company_addresses.company_id')->
                            join('company_address_owners', 'companies.id', '=', 'company_address_owners.company_id')->
                            join('company_bank_details', 'companies.id', '=', 'company_bank_details.company_id')->
                            join('company_contact_details', 'companies.id', '=', 'company_contact_details.company_id')->
                            join('company_emails', 'companies.id', '=', 'company_emails.company_id')->
                            join('company_packaging_details', 'companies.id', '=', 'company_packaging_details.company_id')->
                            join('company_references', 'companies.id', '=', 'company_references.company_id')->
                            join('company_swot_details', 'companies.id', '=', 'company_swot_details.company_id')->
                            join('company_categories', 'companies.company_category', '=', 'company_categories.id')->
                            join('cities', 'companies.company_city', '=', 'cities.id')->where('favorite_flag', '1')->
                            get();
        return $company;
    }

    public function isVerify($id) {
        $user = Session::get('user');
 
        $company = Company::where('id', $id)->first();
        $company->is_verified = 1;
        $company->verified_by = $user->employee_id;
        $company->verified_date = Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $company->save();

        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Company / Verify';
        $logs->log_subject = 'Company "'.$company->company_name.'" was verified by "'.$user->username.'".';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();

        return true;
    }

    public function isFavorite($id) {
        $user = Session::get('user');

        $company = Company::where('id', $id)->first();
        $company->favorite_flag = 1;
        $company->save();

        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Company / Favorite';
        $logs->log_subject = 'Company "'.$company->company_name.'" is in favorite list of "'.$user->username.'".';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();

        return true;
    }

    public function isUnFavorite($id) {
        $user = Session::get('user');

        $company = Company::where('id', $id)->first();
        $company->favorite_flag = 0;
        $company->save();

        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Company / Verify';
        $logs->log_subject = 'Company "'.$company->company_name.'" is not in favorite list of "'.$user->username.'".';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();

        return true;
    }

    public function viewCompany($id) {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        $employees['scope'] = 'edit';
        $employees['editedId'] = $id;

        return view('databank.companies.viewCompany')->with('employees', $employees);
    }

    public function editCompany($id) {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        $employees['scope'] = 'edit';
        $employees['editedId'] = $id;

        return view('databank.companies.editCompany')->with('employees', $employees);
    }

    public function fetchCompany($id) {
        $companyData = [];
        $company = Company::where('id', $id)->first();
        $companyContactDetails = CompanyContactDetails::join('designations', 'company_contact_details.contact_person_designation', '=', 'designations.id')->
                                                        where('company_contact_details.company_id', $id)->
                                                        get(['company_contact_details.*', 'designations.name as contact_person_designation_name']);
        $multipleAddresses = CompanyAddress::join('type_of_addresses', 'company_addresses.address_type', '=', 'type_of_addresses.id')->where('company_addresses.company_id', $id)
                                            ->get(['company_addresses.*', 'type_of_addresses.name as address_type_name']);
        foreach($multipleAddresses as $multipleAddress) {
            $multipleAddress['multipleAddressesOwners'] = CompanyAddressOwner::join('designations', 'company_address_owners.designation', '=', 'designations.id')->
                                                                            where('company_address_owners.company_address_id', $multipleAddress->id)->
                                                                            get(['company_address_owners.*', 'designations.name as designation_name']);
        }
        $multipleEmails = CompanyEmails::where('company_id', $id)->get();
        $swotDetails = CompanySwotDetails::where('company_id', $id)->first();
        $bankDetails = CompanyBankDetails::where('company_id', $id)->first();
        $packagingDetails = CompanyPackagingDetails::where('company_id', $id)->first();
        $referencesDetails = CompanyReferences::where('company_id', $id)->first();

        $companyData['company'] = $company;
        $companyData['contact_details'] = $companyContactDetails;
        $companyData['multiple_address'] = $multipleAddresses;
        $companyData['multiple_emails'] = $multipleEmails;
        $companyData['swot_details'] = $swotDetails;
        $companyData['bank_details'] = $bankDetails;
        $companyData['packaging_details'] = $packagingDetails;
        $companyData['references_details'] = $referencesDetails;

        return $companyData;
    }

    public function deleteCompany($id){
        $company = Company::where('id', $id)->first();

        CompanyContactDetails::where('company_id', $id)->delete();
        CompanyAddress::where('company_id', $id)->delete();
        CompanyAddressOwner::where('company_id', $id)->delete();
        CompanyEmails::where('company_id', $id)->delete();
        CompanySwotDetails::where('company_id', $id)->delete();
        CompanyBankDetails::where('company_id', $id)->delete();
        CompanyPackagingDetails::where('company_id', $id)->delete();
        CompanyReferences::where('company_id', $id)->delete();

        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Company / Delete';
        $logs->log_subject = 'Company - '.$company->company_name.' was deleted by"'.Session::get('user')->username.'".';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();

        $company->delete();
    }

    public function insertCompanyData(Request $request) {        
        $companyData = json_decode($request->company_data);
        $contactDetails = json_decode($request->contact_details);
        $multipleAddresses = json_decode($request->multiple_addresses);
        $multipleEmails = json_decode($request->multiple_emails);
        $swotDetails = json_decode($request->swot_details);
        $referencesDetails = json_decode($request->references_details);
        $packagingDetails = json_decode($request->packaging_details);
        $bankDetails = json_decode($request->bank_details);
        $contactDetailsProfilePic = $request->contact_details_profile_pic;
        $multipleAddressProfilePic = $request->multiple_address_profile_pic;
        dd($companyData);
        if (!file_exists(public_path('upload/company'))) {
            mkdir(public_path('upload/company'), 0777, true);
        }

        if (!file_exists(public_path('upload/company/profilePic'))) {
            mkdir(public_path('upload/company/profilePic'), 0777, true);
        }

        if(is_array($contactDetailsProfilePic) && !empty($contactDetailsProfilePic)) {
            $length = count($contactDetailsProfilePic);
            for ($i=0; $i<$length; $i++) {                
                if ($image = $contactDetailsProfilePic[$i]) {
                    if(!is_string($image)) {                        
                        $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                        $contactDetails[$i]->contact_person_profile_pic = $profileImage;
                        $image->move(public_path('upload/company/profilePic'), $profileImage);
                    } else {
                        $contactDetails[$i]->contact_person_profile_pic = '';
                    }
                }
            }            
        }

        if(is_array($multipleAddressProfilePic) && !empty($multipleAddressProfilePic)) {
            $length = count($multipleAddressProfilePic);
            for ($i=0; $i<$length; $i++) {
                $ownerimage = $multipleAddressProfilePic[$i];
                $ownerLength = count($ownerimage['ownerImage']);
                for ($j=0; $j<$ownerLength; $j++) {
                    if ($image = $ownerimage['ownerImage'][$j]) {
                        if(!is_string($image)) {                        
                            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                            $multipleAddresses[$i]->multipleAddressesOwners[$j]->profile_pic = $profileImage;
                            $image->move(public_path('upload/company/multipleAddressProfilePic'), $profileImage);
                        } else {
                            $multipleAddresses[$i]->multipleAddressesOwners[$j]->profile_pic = '';
                        }
                    }
                }
            }
        }

        $comapnyLastId = Company::orderBy('id', 'DESC')->first('id');
        $companyId = !empty($comapnyLastId) ? $comapnyLastId->id + 1 : 1;
        
        $company = new Company;
        $company->id = $companyId;
        $company->company_name = $companyData->company_name;
        $company->company_type = $companyData->company_type;
        $company->company_country = $companyData->company_country->id;
        $company->company_state = $companyData->company_state->id;
        $company->company_city = $companyData->company_city->id;
        $company->company_website = $companyData->company_website;
        $company->company_landline = $companyData->company_landline;
        $company->company_mobile = $companyData->company_mobile;
        $company->company_watchout = $companyData->company_watchout;
        $company->company_remark_watchout = $companyData->company_remark_watchout;
        $company->company_about = $companyData->company_about;
        $company->company_category = $companyData->company_category->id;
        $company->company_transport = $companyData->company_transport->id;
        $company->company_discount = $companyData->company_discount;
        $company->company_payment_terms_in_days = $companyData->company_payment_terms_in_days;
        $company->company_opening_balance = $companyData->company_opening_balance;
        $company->favorite_flag = 0;
        $company->is_verified = 0;
        $company->verified_by = 0;
        $company->generated_by = Session::get('user')->employee_id;
        $company->updated_by = 0;
        $company->is_linked = 0;
        $company->is_active = 0;
        $company->verified_date = '';
        $company->save();
        
        // Contact Details Data
        if(is_array($contactDetails) && !empty($contactDetails)) {
            foreach($contactDetails as $contactDetail) {
                $companyContactLastId = CompanyContactDetails::orderBy('id', 'DESC')->first('id');
                $companyContactId = !empty($companyContactLastId) ? $companyContactLastId->id + 1 : 1;

                $companyContactDetails = new CompanyContactDetails;
                $companyContactDetails->id = $companyContactId;
                $companyContactDetails->company_id = $comapnyId;
                $companyContactDetails->contact_person_name = $contactDetail->contact_person_name;
                $companyContactDetails->contact_person_designation = $contactDetail->contact_person_designation->id;
                $companyContactDetails->contact_person_profile_pic = $contactDetail->contact_person_profile_pic;
                $companyContactDetails->contact_person_mobile = $contactDetail->contact_person_mobile;
                $companyContactDetails->contact_person_email = $contactDetail->contact_person_email;
                $companyContactDetails->save();
            }
        }

        // Multiple Address Data
        if(is_array($multipleAddresses) && !empty($multipleAddresses)) {
            foreach($multipleAddresses as $multipleAddress) {
                $companyAddressLastId = CompanyAddress::orderBy('id', 'DESC')->first('id');
                $companyAddressId = !empty($companyAddressLastId) ? $companyAddressLastId->id + 1 : 1;

                $companyAddress = new CompanyAddress;
                $companyAddress->id = $companyAddressId;
                $companyAddress->company_id = $comapnyId;
                $companyAddress->address_type = $multipleAddress->address_type->id;
                $companyAddress->address = $multipleAddress->address;
                $companyAddress->country_code = $multipleAddress->country_code;
                $companyAddress->mobile = $multipleAddress->mobile;
                $companyAddress->save();

                if(is_array($multipleAddress->multipleAddressesOwners) && !empty($multipleAddress->multipleAddressesOwners)) {
                    foreach($multipleAddress->multipleAddressesOwners as $owner) {
                        $companyAddressOwnerLastId = CompanyAddressOwner::orderBy('id', 'DESC')->first('id');
                        $companyAddressOwnerId = !empty($companyAddressOwnerLastId) ? $companyAddressOwnerLastId->id + 1 : 1;
        
                        $companyAddressOwner = new CompanyAddressOwner;
                        $companyAddressOwner->id = $companyAddressOwnerId;
                        $companyAddressOwner->company_address_id = $companyAddress->id;
                        $companyAddressOwner->name = $owner->name;
                        $companyAddressOwner->designation = $owner->designation->id;
                        $companyAddressOwner->profile_pic = $owner->profile_pic;
                        $companyAddressOwner->mobile = $owner->mobile;
                        $companyAddressOwner->email = $owner->email;
                        $companyAddressOwner->save();
                    }
                }
            }
        }

        // Multiple Emails Data
        if(is_array($multipleEmails) && !empty($multipleEmails)) {
            foreach($multipleEmails as $multipleEmail) {
                $companyEmailsLastId = CompanyEmails::orderBy('id', 'DESC')->first('id');
                $companyEmailsId = !empty($companyEmailsLastId) ? $companyEmailsLastId->id + 1 : 1;

                $companyEmail = new CompanyEmails;
                $companyEmail->id = $companyEmailsId;
                $companyEmail->company_id = $comapnyId;
                $companyEmail->email_id = $multipleEmail->email_id;
                $companyEmail->save();
            }
        }

        // SWOT Data
        if(!empty($swotDetails)) {
            $swotDetailsLastId = CompanySwotDetails::orderBy('id', 'DESC')->first('id');
            $swotDetailsId = !empty($swotDetailsLastId) ? $swotDetailsLastId->id + 1 : 1;

            $swotData = new CompanySwotDetails;
            $swotData->id = $swotDetailsId;
            $swotData->company_id = $comapnyId;
            $swotData->strength = $swotDetails->strength;
            $swotData->weakness = $swotDetails->weakness;
            $swotData->opportunity = $swotDetails->opportunity;
            $swotData->threat = $swotDetails->threat;
            $swotData->save();
        }

        // Bank Data
        if(!empty($bankDetails)) {
            $bankDetailsLastId = CompanyBankDetails::orderBy('id', 'DESC')->first('id');
            $bankDetailsId = !empty($bankDetailsLastId) ? $bankDetailsLastId->id + 1 : 1;

            $bankDetail = new CompanyBankDetails;
            $bankDetail->id = $bankDetailsId;
            $bankDetail->company_id = $comapnyId;
            $bankDetail->bank_name = $bankDetails->bank_name;
            $bankDetail->account_holder_name = $bankDetails->account_holder_name;
            $bankDetail->account_no = $bankDetails->account_no;
            $bankDetail->branch_name = $bankDetails->branch_name;
            $bankDetail->ifsc_code = $bankDetails->ifsc_code;
            $bankDetail->save();
        }

        // Packaging Data
        if(!empty($packagingDetails)) {
            $packagingDetailsLastId = CompanyPackagingDetails::orderBy('id', 'DESC')->first('id');
            $packagingDetailsId = !empty($packagingDetailsLastId) ? $packagingDetailsLastId->id + 1 : 1;

            $package = new CompanyPackagingDetails;
            $package->id = $packagingDetailsId;
            $package->company_id = $comapnyId;
            $package->gst_no = $packagingDetails->gst_no;
            $package->cst_no = $packagingDetails->cst_no;
            $package->tin_no = $packagingDetails->tin_no;
            $package->vat_no = $packagingDetails->vat_no;
            $package->save();
        }

        // Reference Data
        if(!empty($referencesDetails)) {
            $companyReferencesLastId = CompanyReferences::orderBy('id', 'DESC')->first('id');
            $companyReferencesId = !empty($companyReferencesLastId) ? $companyReferencesLastId->id + 1 : 1;

            $reference = new CompanyReferences;
            $reference->id = $companyReferencesId;
            $reference->company_id = $comapnyId;
            $reference->ref_person_name = $referencesDetails->ref_person_name;
            $reference->ref_person_mobile = $referencesDetails->ref_person_mobile;
            $reference->ref_person_company = $referencesDetails->ref_person_company;
            $reference->ref_person_address = $referencesDetails->ref_person_address;
            $reference->save();
        }

        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Company / Add';
        $logs->log_subject = 'Company - "'.$company->company_name.'" was inserted from '.Session::get('user')->username.'.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }

    public function updateCompanyData(Request $request) {
        $companyData = json_decode($request->company_data);
        $contactDetails = json_decode($request->contact_details);
        $multipleAddresses = json_decode($request->multiple_addresses);
        $multipleEmails = json_decode($request->multiple_emails);
        $swotDetails = json_decode($request->swot_details);
        $referencesDetails = json_decode($request->references_details);
        $packagingDetails = json_decode($request->packaging_details);
        $bankDetails = json_decode($request->bank_details);
        $contactDetailsProfilePic = $request->contact_details_profile_pic;
        $multipleAddressProfilePic = $request->multiple_address_profile_pic;

        $id = $companyData->id;

        if(is_array($contactDetailsProfilePic) && !empty($contactDetailsProfilePic)) {
            $length = count($contactDetailsProfilePic);
            for ($i=0; $i<$length; $i++) {                
                if ($image = $contactDetailsProfilePic[$i]) {
                    if(!is_string($image)) {                        
                        $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                        $contactDetails[$i]->contact_person_profile_pic = $profileImage;
                        $image->move(public_path('upload/company/profilePic'), $profileImage);
                    } else {
                        $contactDetails[$i]->contact_person_profile_pic = '';
                    }
                }
            }            
        }

        if(is_array($multipleAddressProfilePic) && !empty($multipleAddressProfilePic)) {
            $length = count($multipleAddressProfilePic);
            for ($i=0; $i<$length; $i++) {
                $ownerimage = $multipleAddressProfilePic[$i];
                $ownerLength = count($ownerimage['ownerImage']);
                for ($j=0; $j<$ownerLength; $j++) {
                    if ($image = $ownerimage['ownerImage'][$j]) {
                        if(!is_string($image)) {                        
                            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                            $multipleAddresses[$i]->multipleAddressesOwners[$j]->profile_pic = $profileImage;
                            $image->move(public_path('upload/company/multipleAddressProfilePic'), $profileImage);
                        } else {
                            $multipleAddresses[$i]->multipleAddressesOwners[$j]->profile_pic = '';
                        }
                    }
                }
            }
        }

        $company = Company::where('id', $id)->first();
        $company->company_name = $companyData->company_name;
        $company->company_type = $companyData->company_type;
        $company->company_country = $companyData->company_country;
        $company->company_state = $companyData->company_state;
        $company->company_city = $companyData->company_city;
        $company->company_website = $companyData->company_website;
        $company->company_landline = $companyData->company_landline;
        $company->company_mobile = $companyData->company_mobile;
        $company->company_watchout = $companyData->company_watchout;
        $company->company_remark_watchout = $companyData->company_remark_watchout;
        $company->company_about = $companyData->company_about;
        $company->company_category = $companyData->company_category;
        $company->company_transport = $companyData->company_transport;
        $company->company_discount = $companyData->company_discount;
        $company->company_payment_terms_in_days = $companyData->company_payment_terms_in_days;
        $company->company_opening_balance = $companyData->company_opening_balance;
        $company->updated_by = Session::get('user')->employee_id;
        $company->save();
        
        // Contact Details Data
        if(is_array($contactDetails) && !empty($contactDetails)) {
            foreach($contactDetails as $contactDetail) {
                $companyContactDetails = CompanyContactDetails::where('company_id', $id)->first();
                $companyContactDetails->contact_person_name = $contactDetail->contact_person_name;
                $companyContactDetails->contact_person_designation = $contactDetail->contact_person_designation;
                $companyContactDetails->contact_person_profile_pic = $contactDetail->contact_person_profile_pic;
                $companyContactDetails->contact_person_mobile = $contactDetail->contact_person_mobile;
                $companyContactDetails->contact_person_email = $contactDetail->contact_person_email;
                $companyContactDetails->save();
            }
        }

        // Multiple Address Data
        if(is_array($multipleAddresses) && !empty($multipleAddresses)) {
            foreach($multipleAddresses as $multipleAddress) {
                $companyAddress = CompanyAddress::where('company_id', $id)->first();
                $companyAddress->address_type = $multipleAddress->address_type;
                $companyAddress->address = $multipleAddress->address;
                $companyAddress->mobile = $multipleAddress->mobile;
                $companyAddress->save();

                if(is_array($multipleAddress->multipleAddressesOwners) && !empty($multipleAddress->multipleAddressesOwners)) {
                    foreach($multipleAddress->multipleAddressesOwners as $owner) {
                        $companyAddressOwner = CompanyAddressOwner::where('company_address_id', $companyAddress->id)->first();
                        $companyAddressOwner->name = $owner->name;
                        $companyAddressOwner->designation = $owner->designation;
                        $companyAddressOwner->profile_pic = $owner->profile_pic;
                        $companyAddressOwner->mobile = $owner->mobile;
                        $companyAddressOwner->email = $owner->email;
                        $companyAddressOwner->save();
                    }
                }
            }
        }

        // Multiple Emails Data
        if(is_array($multipleEmails) && !empty($multipleEmails)) {
            foreach($multipleEmails as $multipleEmail) {
                $companyEmail = CompanyEmails::where('company_id', $id)->first();
                $companyEmail->email_id = $multipleEmail->email_id;
                $companyEmail->save();
            }
        }

        // SWOT Data
        if(!empty($swotDetails)) {
            $swotData = CompanySwotDetails::where('company_id', $id)->first();
            $swotData->strength = $swotDetails->strength;
            $swotData->weakness = $swotDetails->weakness;
            $swotData->opportunity = $swotDetails->opportunity;
            $swotData->threat = $swotDetails->threat;
            $swotData->save();
        }

        // Bank Data
        if(!empty($bankDetails)) {
            $bankDetail = CompanyBankDetails::where('company_id', $id)->first();
            $bankDetail->bank_name = $bankDetails->bank_name;
            $bankDetail->account_holder_name = $bankDetails->account_holder_name;
            $bankDetail->account_no = $bankDetails->account_no;
            $bankDetail->branch_name = $bankDetails->branch_name;
            $bankDetail->ifsc_code = $bankDetails->ifsc_code;
            $bankDetail->save();
        }

        // Packaging Data
        if(!empty($packagingDetails)) {
            $package = CompanyPackagingDetails::where('company_id', $id)->first();
            $package->gst_no = $packagingDetails->gst_no;
            $package->cst_no = $packagingDetails->cst_no;
            $package->tin_no = $packagingDetails->tin_no;
            $package->vat_no = $packagingDetails->vat_no;
            $package->save();
        }

        // Reference Data
        if(!empty($referencesDetails)) {
            $reference = CompanyReferences::where('company_id', $id)->first();
            $reference->ref_person_name = $referencesDetails->ref_person_name;
            $reference->ref_person_mobile = $referencesDetails->ref_person_mobile;
            $reference->ref_person_company = $referencesDetails->ref_person_company;
            $reference->ref_person_address = $referencesDetails->ref_person_address;
            $reference->save();
        }

        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Company / Edit';
        $logs->log_subject = 'Company - "'.$companyData->company_name.'" was updated from '.Session::get('user')->username.'.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }
}
