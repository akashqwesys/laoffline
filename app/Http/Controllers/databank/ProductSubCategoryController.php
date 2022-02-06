<?php

namespace App\Http\Controllers\databank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Employee;
use App\Models\ProductFabricGroup;
use App\Models\ProductCategory;
use App\Models\Logs;
use App\Models\Company\Company;
use Illuminate\Support\Facades\Session;
use DB;

class ProductSubCategoryController extends Controller
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
        $logs->log_path = 'ProductSubCategory / View';
        $logs->log_subject = 'Product Sub Category view page visited.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();

        return view('databank.productSubCategories.productSubCategory')->with('employees', $employees);
    }

    public function createProductSubCategory() {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        return view('databank.productSubCategories.createProductSubCategory')->with('employees', $employees);
    }

    public function listProductSubCategory() {
        $productSubCategory = ProductCategory::join('product_categories as pc','product_categories.main_category_id','=','pc.id')->
                                               where('product_categories.main_category_id', '!=', '0')->
                                               where('product_categories.is_delete', '0')->
                                               get(['product_categories.*', 'pc.name as categoryName']);

        foreach($productSubCategory as $category) {
            $id = $category->company_id;
            if (!empty($id)) {
                if(is_array(json_decode($id))) {
                    $companyName = [];
                    $companyArr = json_decode($id);

                    foreach($companyArr as $key => $c) {
                        $company = Company::where('id', $c)->first('company_name');
                        $companyName[$key] = $company->company_name;
                    }                
                }
                $category['companyName'] = is_array($companyName) ? implode(", ", $companyName) : $companyName;
            } else {
                $category['companyName'] = '';
            }
            
            if ($category->product_fabric_id != 0) {
                $fabricGroup = productFabricGroup::where('id', $category->product_fabric_id)->first('name');
                $category['fabricGroupName'] = $fabricGroup->name;
            } else {
                $category['fabricGroupName'] = '';
            }
        }

        return $productSubCategory;
    }

    public function getCompanyName($id) {    
        if(is_array(json_decode($id))) {
            $companyName = [];
            $companyArr = json_decode($id);

            foreach($companyArr as $key => $c) {
                $company = Company::where('id', $c)->first('company_name');
                $companyName[$key] = $company->company_name;
            }                
        } else {
            $company = Company::where('id', $id)->first('company_name');
            $companyName = $company->company_name;
        }
        $name = is_array($companyName) ? implode(", ", $companyName) : $companyName;

        return $name;
    }

    public function listProductFabricGroup() {
        $productFabricGroup = ProductFabricGroup::all();

        return $productFabricGroup;
    }

    public function listCompanies() {
        $companies = Company::get(['company_name', 'id']);

        return $companies;
    }

    public function editProductSubCategory($id) {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        $employees['scope'] = 'edit';
        $employees['editedId'] = $id;

        return view('databank.productSubCategories.editProductSubCategory')->with('employees', $employees);
    }

    public function fetchProductSubCategory($id) {
        $productSubCategoryData = [];
        $productSubCategory = ProductCategory::where('id', $id)->first();

        $productSubCategoryData['id'] = $productSubCategory->id;
        $productSubCategoryData['multiple_company'] = $productSubCategory->multiple_company;

        if($productSubCategory->multiple_company == 1) {
            
            $category = ProductCategory::first(['name as category_name', 'id as category_id']);
            $productSubCategoryData['main_category'] = $category;
            
            if ($productSubCategory->product_fabric_id != 0) {
                $fabricGroup = productFabricGroup::where('id', $productSubCategory->product_fabric_id)->first();
                $productSubCategoryData['fabric_group'] = $fabricGroup;
            } else {
                $productSubCategoryData['fabric_group'] = [];
            }

            if(is_array(json_decode($productSubCategory->company_id))) {
                $companyName = [];
                $companyArr = json_decode($productSubCategory->company_id);
                foreach($companyArr as $key => $c) {
                    $company = Company::where('id', $c)->first();
                    $companyName[$key]['company_name'] = $company->company_name;
                    $companyName[$key]['id'] = $company->id;
                }
                
                $productSubCategoryData['company'] = $companyName;
                $productSubCategoryData['sub_category_name'] = $productSubCategory->name;
                $productSubCategoryData['sort_order'] = $productSubCategory->sort_order;
            }
        } elseif($productSubCategory->multiple_company == 0) {
            $category = ProductCategory::first(['name as category_name', 'id as category_id']);
            $productSubCategoryData['subCategory'][0]['mainCategory'] = $category;
            
            if ($productSubCategory->product_fabric_id != 0) {
                $fabricGroup = productFabricGroup::where('id', $productSubCategory->product_fabric_id)->first();
                $productSubCategoryData['subCategory'][0]['mfabric_group'] = $fabricGroup;
            } else {
                $productSubCategoryData['subCategory'][0]['mfabric_group'] = [];
            }

            $companyName = [];            
            
            $company = Company::where('id', $productSubCategory->company_id)->first();
            $companyName['company_name'] = $company->company_name;
            $companyName['id'] = $company->id;            
                
            $productSubCategoryData['company'] = $companyName;
            $productSubCategoryData['subCategory'][0]['sub_category_name'] = $productSubCategory->name;
            $productSubCategoryData['subCategory'][0]['rate'] = $productSubCategory->rate;
            $productSubCategoryData['subCategory'][0]['sort_order'] = $productSubCategory->sort_order;
        }

        return $productSubCategoryData;
    }


    public function deleteProductSubCategory($id){
        $productCategoryData = ProductCategory::where('id',$id)->first();
        $productCategoryData->is_delete = 1;
        $productCategoryData->save();
        
        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Product Sub Category / Delete';
        $logs->log_subject = 'Product Sub Category - "'.$productCategoryData->sub_category_name.'" was deleted.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }

    public function insertProductSubCategoryData(Request $request) {
        if ($request->multiple_company == 1) {
            $this->validate($request, [
                'main_category' => 'required',
                'company' => 'required',
                'sub_category_name' => 'required',
            ]);

        } elseif ($request->multiple_company == 0) {
            $this->validate($request, [
                'singleCompany' => 'required',
                'mainCategory' => 'required',
                'sub_category_name' => 'required',
            ]);

        }
        
        $company_id = [];

        if($request->multiple_company == 1) {
            foreach($request->company as $key => $com) {
                $company_id[$key] = $com['id'];
            }

            $productCategoryLastId = ProductCategory::orderBy('id', 'DESC')->first('id');
            $productCategoryId = !empty($productCategoryLastId) ? $productCategoryLastId->id + 1 : 1;
    
            $productCategory = new ProductCategory;
            $productCategory->id = $productCategoryId;
            $productCategory->multiple_company = $request->multiple_company;
            $productCategory->product_default_category_id = 0;
            $productCategory->main_category_id = $request->main_category['category_id'];
            if ($request->fabric_group != null) {
                $productCategory->product_fabric_id = $request->fabric_group['id'];
            } else {
                $productCategory->product_fabric_id = 0;
            }
            $productCategory->name = $request->sub_category_name;
            $productCategory->company_id = json_encode($company_id);
            $productCategory->rate = 0;
            $productCategory->sort_order = $request->sort_order;
            $productCategory->save();

        } else if($request->multiple_company == 0) {
            foreach($request->productSubCategory as $subCategory) {
                $productCategoryLastId = ProductCategory::orderBy('id', 'DESC')->first('id');
                $productCategoryId = !empty($productCategoryLastId) ? $productCategoryLastId->id + 1 : 1;
        
                $productCategory = new ProductCategory;
                $productCategory->id = $productCategoryId;
                $productCategory->multiple_company = $request->multiple_company;
                $productCategory->product_default_category_id = 0;
                $productCategory->main_category_id = $subCategory['mainCategory']['category_id'];
                if ($subCategory['mfabric_group'] != null) {
                    $productCategory->product_fabric_id = $subCategory['mfabric_group']['id'];
                } else {
                    $productCategory->product_fabric_id = 0;
                }
                $productCategory->name = $subCategory['sub_category_name'];
                $productCategory->company_id = $request->singleCompany['id'];
                $productCategory->rate = $subCategory['rate'];
                $productCategory->sort_order = $subCategory['sort_order'];
                $productCategory->save();
            }
        }

        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Product sub category / Add';
        $logs->log_subject = 'Product sub category - "'.$request->sub_category_name.'" was inserted from '.Session::get('user')->username.'.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }

    public function updateProductSubCategoryData(Request $request) {
        $this->validate($request, [
            'main_category' => 'required',
            'company' => 'required',
            'sub_category_name' => 'required',
        ]);
        $id = $request->id;
        $company_id = [];

        if($request->multiple_company == 1) {
            foreach($request->company as $key => $com) {
                $company_id[$key] = $com['id'];
            }
            $productCategory = ProductCategory::where('id', $id)->first();
            $productCategory->multiple_company = $request->multiple_company;
            $productCategory->product_default_category_id = 0;
            $productCategory->main_category_id = $request->main_category['category_id'];
            if ($request['fabric_group'] != null) {
                $productCategory->product_fabric_id = $request['fabric_group']['id'];
            } else {
                $productCategory->product_fabric_id = 0;
            }
            $productCategory->name = $request->sub_category_name;
            $productCategory->company_id = json_encode($company_id);
            $productCategory->rate = 0;
            $productCategory->sort_order = $request->sort_order;
            $productCategory->save();

        } else if($request->multiple_company == 0) {

            foreach($request->productSubCategory as $key => $subCategory) {
                if ($key == 0) {
                    $productCategory = ProductCategory::where('id', $id)->first();
                } else {
                    $productCategoryLastId = ProductCategory::orderBy('id', 'DESC')->first('id');
                    $productCategoryId = !empty($productCategoryLastId) ? $productCategoryLastId->id + 1 : 1;
                    $productCategory = new ProductCategory;
                    $productCategory->id = $productCategoryId;
                }
                $productCategory->multiple_company = $request->multiple_company;
                $productCategory->product_default_category_id = 0;
                $productCategory->main_category_id = $subCategory['mainCategory']['category_id'];
                if ($subCategory['mfabric_group'] != null) {
                    $productCategory->product_fabric_id = $subCategory['mfabric_group']['id'];
                } else {
                    $productCategory->product_fabric_id = 0;
                }
                $productCategory->name = $subCategory['sub_category_name'];
                $productCategory->company_id = $request->singleCompany['id'];
                $productCategory->rate = $subCategory['rate'];
                $productCategory->sort_order = $subCategory['sort_order'];
                $productCategory->save();
            }
        }

        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Product sub category / Edit';
        $logs->log_subject = 'Product sub category - "'.$request->sub_category_name.'" was updated from '.Session::get('user')->username.'.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }
}
