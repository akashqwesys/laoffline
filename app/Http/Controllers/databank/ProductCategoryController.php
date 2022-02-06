<?php

namespace App\Http\Controllers\databank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Employee;
use App\Models\ProductCategory;
use App\Models\ProductDefaultCategory;
use App\Models\Logs;
use Illuminate\Support\Facades\Session;

class ProductCategoryController extends Controller
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
        $logs->log_path = 'ProductCategory / View';
        $logs->log_subject = 'Product Category view page visited.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();

        return view('databank.productCategories.productCategory')->with('employees', $employees);
    }

    public function createProductCategory() {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        return view('databank.productCategories.createProductCategory')->with('employees', $employees);
    }

    public function listProductCategory() {
        $productCategory = ProductCategory::join('product_default_categories','product_categories.product_default_category_id','=','product_default_categories.id')->
                                            where('product_categories.product_default_category_id', '!=', '0')->
                                            where('product_categories.is_delete', '0')->
                                            get(['product_default_categories.name as default_category', 'product_categories.name as category_name', 'product_categories.id as category_id']);

        return $productCategory;
    }

    public function listProductDefaultCategoriesCategory() {
        $productDfaultCategory = ProductDefaultCategory::get(['id', 'name']);

        return $productDfaultCategory;
    }

    public function editProductCategory($id) {
        $user = Session::get('user');
        $employees = Employee::join('users', 'employees.id', '=', 'users.employee_id')->
                                join('user_groups', 'employees.user_group', '=', 'user_groups.id')->where('employees.id', $user->employee_id)->first();

        $employees['scope'] = 'edit';
        $employees['editedId'] = $id;

        return view('databank.productCategories.editProductCategory')->with('employees', $employees);
    }

    public function fetchProductCategory($id) {        
        $defaultCategory = [];
        $productCategories = ProductCategory::join('product_default_categories','product_categories.product_default_category_id','=','product_default_categories.id')->
                                              where('product_categories.product_default_category_id', '!=', '0')->
                                              where('product_categories.id', $id)->first(['product_categories.*', 'product_default_categories.name as default_category']);

        $defaultCategory['id'] = $productCategories->product_default_category_id;
        $defaultCategory['name'] = $productCategories->default_category;
        $productCategories['defaultCategory'] = $defaultCategory;

        return $productCategories;
    }

    public function deleteProductCategory($id){
        $productCategoryData = ProductCategory::where('id',$id)->first();
        $productCategoryData->is_delete = 1;
        $productCategoryData->save();
        
        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Product Category / Delete';
        $logs->log_subject = 'Product Category - "'.$productCategoryData->category_name.'" was deleted.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }

    public function insertProductCategoryData(Request $request) {
        $this->validate($request, [
            'default_category' => 'required',
            'name' => 'required',
            'sort_order' => 'required',
        ]);

        $productCategoryLastId = ProductCategory::orderBy('id', 'DESC')->first('id');
        $productCategoryId = !empty($productCategoryLastId) ? $productCategoryLastId->id + 1 : 1;

        $productCategory = new ProductCategory;
        $productCategory->id = $productCategoryId;
        $productCategory->product_default_category_id = $request->default_category['id'];
        $productCategory->name = $request->name;
        $productCategory->main_category_id = 0;
        $productCategory->company_id = 0;
        $productCategory->product_fabric_id = 0;
        $productCategory->multiple_company = 0;
        $productCategory->rate = 0;
        $productCategory->sort_order = $request->sort_order;
        $productCategory->save();

        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Product category / Add';
        $logs->log_subject = 'Product category - "'.$request->category_name.'" was inserted from '.Session::get('user')->username.'.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }

    public function updateProductCategoryData(Request $request) {
        $this->validate($request, [
            'default_category' => 'required',
            'name' => 'required',
            'sort_order' => 'required',
        ]);
        
        $id = $request->id;

        $productCategory = ProductCategory::where('id', $id)->first();        
        $productCategory->product_default_category_id = $request->default_category['id'];
        $productCategory->name = $request->name;
        $productCategory->sort_order = $request->sort_order;
        $productCategory->save();

        $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
        $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                        
        $logs = new Logs;
        $logs->id = $logsId;
        $logs->employee_id = Session::get('user')->employee_id;
        $logs->log_path = 'Product category / Edit';
        $logs->log_subject = 'Product category - "'.$request->category_name.'" was updated from '.Session::get('user')->username.'.';
        $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $logs->save();
    }
}
