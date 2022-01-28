<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Auth::routes();

Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'index'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('register');

Route::get('/home', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');

// Routes for Databank / User Group
Route::group(['middleware' => ['auth', 'permission:access-user-group']], function() {
    Route::get('/databank/users-group', [App\Http\Controllers\databank\UserGroupController::class, 'index'])->name('users-group');
    Route::get('/databank/users-group/getPermission', [App\Http\Controllers\databank\UserGroupController::class, 'getPermissions'])->name('getPermissions');
    Route::get('/databank/users-group/list', [App\Http\Controllers\databank\UserGroupController::class, 'listUserGroup'])->name('list');
    Route::get('/databank/users-group/fetch-user-group/{id}', [App\Http\Controllers\databank\UserGroupController::class, 'fetchUserGroup']);
});

Route::group(['middleware' => ['auth', 'permission:modify-user-group']], function() {
    Route::get('/databank/users-group/create-user-group', [App\Http\Controllers\databank\UserGroupController::class, 'createUserGroup']);
    Route::post('/databank/users-group/create', [App\Http\Controllers\databank\UserGroupController::class, 'insertUserGroupData']);
    Route::post('/databank/users-group/update', [App\Http\Controllers\databank\UserGroupController::class, 'updateUserGroupData']);
    Route::get('/databank/users-group/edit-user-group/{id}', [App\Http\Controllers\databank\UserGroupController::class, 'editUserGroup']);
    Route::delete('/databank/users-group/delete/{id}', [App\Http\Controllers\databank\UserGroupController::class, 'deleteUserGroup'])->name('delete');
});


// Routes for Databank / Employee
Route::group(['middleware' => ['auth', 'permission:access-employee']], function() {
    Route::get('/databank/employee', [App\Http\Controllers\databank\EmployeesController::class, 'index'])->name('employee');
    Route::get('/databank/employee/getPermission', [App\Http\Controllers\databank\EmployeesController::class, 'getPermissions'])->name('getPermissions');
    Route::get('/databank/employee/list', [App\Http\Controllers\databank\EmployeesController::class, 'listEmployee'])->name('list');
    Route::get('/databank/employee/fetch-employee/{id}', [App\Http\Controllers\databank\EmployeesController::class, 'fetchEmployee']);
});

Route::group(['middleware' => ['auth', 'permission:modify-employee']], function() {
    Route::get('/databank/employee/create-employee', [App\Http\Controllers\databank\EmployeesController::class, 'createEmployee']);
    Route::post('/databank/employee/create', [App\Http\Controllers\databank\EmployeesController::class, 'insertEmployeeData']);
    Route::post('/databank/employee/update', [App\Http\Controllers\databank\EmployeesController::class, 'updateEmployeeData']);
    Route::get('/databank/employee/edit-employee/{id}', [App\Http\Controllers\databank\EmployeesController::class, 'editEmployee']);
    Route::delete('/databank/employee/delete/{id}', [App\Http\Controllers\databank\EmployeesController::class, 'deleteEmployee'])->name('delete');
});


// Routes for Logs
Route::get('/logs', [App\Http\Controllers\LogsController::class, 'index'])->name('logs');
Route::get('/logs/list', [App\Http\Controllers\LogsController::class, 'listLogs'])->name('list');


// Routes for Databank / Product Category
Route::group(['middleware' => ['auth', 'permission:access-product-category']], function() {
    Route::get('/databank/product-category', [App\Http\Controllers\databank\ProductCategoryController::class, 'index'])->name('product-category');
    Route::get('/databank/product-category/list', [App\Http\Controllers\databank\ProductCategoryController::class, 'listProductCategory'])->name('list');
    Route::get('/databank/product-category/list-default-category', [App\Http\Controllers\databank\ProductCategoryController::class, 'listProductDefaultCategoriesCategory'])->name('list-default-category');
    Route::get('/databank/product-category/fetch-product-category/{id}', [App\Http\Controllers\databank\ProductCategoryController::class, 'fetchProductCategory']);
});

Route::group(['middleware' => ['auth', 'permission:modify-product-category']], function() {
    Route::get('/databank/product-category/create-product-category', [App\Http\Controllers\databank\ProductCategoryController::class, 'createProductCategory']);
    Route::post('/databank/product-category/create', [App\Http\Controllers\databank\ProductCategoryController::class, 'insertProductCategoryData']);
    Route::post('/databank/product-category/update', [App\Http\Controllers\databank\ProductCategoryController::class, 'updateProductCategoryData']);
    Route::get('/databank/product-category/edit-product-category/{id}', [App\Http\Controllers\databank\ProductCategoryController::class, 'editProductCategory']);
    Route::delete('/databank/product-category/delete/{id}', [App\Http\Controllers\databank\ProductCategoryController::class, 'deleteProductCategory'])->name('delete');
});



// Routes for Databank / Product Sub Category
Route::group(['middleware' => ['auth', 'permission:access-product-sub-category']], function() {
    Route::get('/databank/productsub-category', [App\Http\Controllers\databank\ProductSubCategoryController::class, 'index'])->name('productsub-category');
    Route::get('/databank/productsub-category/list', [App\Http\Controllers\databank\ProductSubCategoryController::class, 'listProductSubCategory'])->name('list');
    Route::get('/databank/productsub-category/company-name/{id}', [App\Http\Controllers\databank\ProductSubCategoryController::class, 'getCompanyName'])->name('company-name');
    Route::get('/databank/productsub-category/listCompanies', [App\Http\Controllers\databank\ProductSubCategoryController::class, 'listCompanies'])->name('listCompanies');
    Route::get('/databank/productsub-category/listProductFabricGroup', [App\Http\Controllers\databank\ProductSubCategoryController::class, 'listProductFabricGroup'])->name('listProductFabricGroup');
    Route::get('/databank/productsub-category/fetch-productsub-category/{id}', [App\Http\Controllers\databank\ProductSubCategoryController::class, 'fetchProductSubCategory']);
});

Route::group(['middleware' => ['auth', 'permission:modify-product-sub-category']], function() {
    Route::get('/databank/productsub-category/create-productsub-category', [App\Http\Controllers\databank\ProductSubCategoryController::class, 'createProductSubCategory']);
    Route::post('/databank/productsub-category/create', [App\Http\Controllers\databank\ProductSubCategoryController::class, 'insertProductSubCategoryData']);
    Route::post('/databank/productsub-category/update', [App\Http\Controllers\databank\ProductSubCategoryController::class, 'updateProductSubCategoryData']);
    Route::get('/databank/productsub-category/edit-productsub-category/{id}', [App\Http\Controllers\databank\ProductSubCategoryController::class, 'editProductSubCategory']);
    Route::delete('/databank/productsub-category/delete/{id}', [App\Http\Controllers\databank\ProductSubCategoryController::class, 'deleteProductSubCategory'])->name('delete');
});


// Routes for Databank / Company Category
Route::group(['middleware' => ['auth', 'permission:access-company-category']], function() {
    Route::get('/databank/companyCategory', [App\Http\Controllers\databank\CompanyCategoryController::class, 'index'])->name('companyCategory');
    Route::get('/databank/companyCategory/list', [App\Http\Controllers\databank\CompanyCategoryController::class, 'listCompanyCategory'])->name('list');
    Route::get('/databank/companyCategory/fetch-company-category/{id}', [App\Http\Controllers\databank\CompanyCategoryController::class, 'fetchCompanyCategory']);
});

Route::group(['middleware' => ['auth', 'permission:modify-company-category']], function() {
    Route::get('/databank/companyCategory/create-company-category', [App\Http\Controllers\databank\CompanyCategoryController::class, 'createCompanyCategory']);
    Route::post('/databank/companyCategory/create', [App\Http\Controllers\databank\CompanyCategoryController::class, 'insertCompanyCategoryData']);
    Route::post('/databank/companyCategory/update', [App\Http\Controllers\databank\CompanyCategoryController::class, 'updateCompanyCategoryData']);
    Route::get('/databank/companyCategory/edit-company-category/{id}', [App\Http\Controllers\databank\CompanyCategoryController::class, 'editCompanyCategory']);
    Route::delete('/databank/companyCategory/delete/{id}', [App\Http\Controllers\databank\CompanyCategoryController::class, 'deleteCompanyCategory'])->name('delete');
});


// Routes for Databank / Company
Route::group(['middleware' => ['auth', 'permission:access-company']], function() {
    Route::get('/databank/companies', [App\Http\Controllers\databank\CompanyController::class, 'index'])->name('companies');
    Route::get('/databank/companies/list', [App\Http\Controllers\databank\CompanyController::class, 'listCompany'])->name('list');
    Route::get('/databank/companies/category-name/{id}', [App\Http\Controllers\databank\CompanyController::class, 'getCompanyCategory'])->name('category-name');
    Route::get('/databank/companies/list-essential', [App\Http\Controllers\databank\CompanyController::class, 'listEssentialCompany'])->name('list-essential');
    Route::get('/databank/companies/fetch-company/{id}', [App\Http\Controllers\databank\CompanyController::class, 'fetchCompany']);
});

Route::group(['middleware' => ['auth', 'permission:modify-company']], function() {
    Route::get('/databank/companies/create-company', [App\Http\Controllers\databank\CompanyController::class, 'createCompany']);
    Route::post('/databank/companies/create', [App\Http\Controllers\databank\CompanyController::class, 'insertCompanyData']);
    Route::post('/databank/companies/update', [App\Http\Controllers\databank\CompanyController::class, 'updateCompanyData']);
    Route::post('/databank/companies/verify/{id}', [App\Http\Controllers\databank\CompanyController::class, 'isVerify'])->name('verify');
    Route::post('/databank/companies/favorite/{id}', [App\Http\Controllers\databank\CompanyController::class, 'isFavorite'])->name('favorite');
    Route::post('/databank/companies/unFavorite/{id}', [App\Http\Controllers\databank\CompanyController::class, 'isUnFavorite'])->name('unFavorite');
    Route::get('/databank/companies/view-company/{id}', [App\Http\Controllers\databank\CompanyController::class, 'viewCompany']);
    Route::get('/databank/companies/edit-company/{id}', [App\Http\Controllers\databank\CompanyController::class, 'editCompany']);
    Route::delete('/databank/companies/delete/{id}', [App\Http\Controllers\databank\CompanyController::class, 'deleteCompany'])->name('delete');
});


// Routes for Databank / Product
Route::group(['middleware' => ['auth', 'permission:access-product']], function() {
    Route::get('/databank/catalog', [App\Http\Controllers\databank\ProductsController::class, 'index'])->name('catalog');
    Route::get('/databank/catalog/list', [App\Http\Controllers\databank\ProductsController::class, 'listProducts'])->name('list');
    Route::get('/databank/catalog/main-category/{id}', [App\Http\Controllers\databank\ProductsController::class, 'mainCategory'])->name('mainCategory');
    Route::get('/databank/catalog/sub-category/{id}/{companyId}', [App\Http\Controllers\databank\ProductsController::class, 'subCategory'])->name('subCategory');
    Route::get('/databank/catalog/fabric-field/{id}', [App\Http\Controllers\databank\ProductsController::class, 'fabricField'])->name('fabricField');
    Route::get('/databank/catalog/list-companies', [App\Http\Controllers\databank\ProductsController::class, 'listCompanies'])->name('list-companies');
    Route::get('/databank/catalog/fetch-product/{id}', [App\Http\Controllers\databank\ProductsController::class, 'fetchProducts']);
});

Route::group(['middleware' => ['auth', 'permission:modify-product']], function() {
    Route::get('/databank/catalog/create-products', [App\Http\Controllers\databank\ProductsController::class, 'createProducts']);
    Route::post('/databank/catalog/create', [App\Http\Controllers\databank\ProductsController::class, 'insertProductsData']);
    Route::post('/databank/catalog/create-company', [App\Http\Controllers\databank\ProductsController::class, 'insertCompaniesData']);
    Route::post('/databank/catalog/update', [App\Http\Controllers\databank\ProductsController::class, 'updateProductsData']);
    Route::get('/databank/catalog/edit-products/{id}', [App\Http\Controllers\databank\ProductsController::class, 'editProducts']);
    Route::delete('/databank/catalog/delete/{id}', [App\Http\Controllers\databank\ProductsController::class, 'deleteProducts'])->name('delete');
});



// Routes for Databank / Link Companies
Route::group(['middleware' => ['auth', 'permission:access-link-companies']], function() {
    Route::get('/databank/link-company', [App\Http\Controllers\databank\LinkCompaniesController::class, 'index'])->name('link-company');
    Route::get('/databank/link-company/list', [App\Http\Controllers\databank\LinkCompaniesController::class, 'listLinkCompanies'])->name('list');
    Route::get('/databank/link-company/listCompanies', [App\Http\Controllers\databank\LinkCompaniesController::class, 'listCompanies'])->name('listCompanies');
    Route::get('/databank/link-company/getComapnyById/{id}', [App\Http\Controllers\databank\LinkCompaniesController::class, 'getComapnyById'])->name('getComapnyById');
    Route::get('/databank/link-company/getLinkedComapnyById/{id}', [App\Http\Controllers\databank\LinkCompaniesController::class, 'getLinkedComapnyById'])->name('getLinkedComapnyById');
    Route::get('/databank/link-company/fetch-link-company/{id}', [App\Http\Controllers\databank\LinkCompaniesController::class, 'fetchLinkCompanies']);
});

Route::group(['middleware' => ['auth', 'permission:modify-link-companies']], function() {
    Route::get('/databank/link-company/create-link-company', [App\Http\Controllers\databank\LinkCompaniesController::class, 'createLinkCompanies']);
    Route::post('/databank/link-company/create', [App\Http\Controllers\databank\LinkCompaniesController::class, 'insertLinkCompaniesData']);
    Route::post('/databank/link-company/merge', [App\Http\Controllers\databank\LinkCompaniesController::class, 'mergeLinkCompaniesData']);
    Route::post('/databank/link-company/update', [App\Http\Controllers\databank\LinkCompaniesController::class, 'updateLinkCompaniesData']);
    Route::get('/databank/link-company/edit-link-company/{id}', [App\Http\Controllers\databank\LinkCompaniesController::class, 'editLinkCompanies']);
    Route::delete('/databank/link-company/delete/{id}', [App\Http\Controllers\databank\LinkCompaniesController::class, 'deleteLinkCompanies'])->name('delete');
});


// Routes for Settings / Bank Details
Route::group(['middleware' => ['auth', 'permission:access-bank-details']], function() {
    Route::get('/settings/bank-details', [App\Http\Controllers\settings\BankDetailsController::class, 'index'])->name('bank-details');
    Route::get('/settings/bank-details/list', [App\Http\Controllers\settings\BankDetailsController::class, 'listBankDetails'])->name('list');
    Route::get('/settings/bank-details/fetch-bank-details/{id}', [App\Http\Controllers\settings\BankDetailsController::class, 'fetchBankDetails']);
});

Route::group(['middleware' => ['auth', 'permission:modify-bank-details']], function() {
    Route::get('/settings/bank-details/create-bank-details', [App\Http\Controllers\settings\BankDetailsController::class, 'createBankDetails']);
    Route::post('/settings/bank-details/create', [App\Http\Controllers\settings\BankDetailsController::class, 'insertBankDetailsData']);
    Route::post('/settings/bank-details/update', [App\Http\Controllers\settings\BankDetailsController::class, 'updateBankDetailsData']);
    Route::get('/settings/bank-details/edit-bank-details/{id}', [App\Http\Controllers\settings\BankDetailsController::class, 'editBankDetails']);
    Route::delete('/settings/bank-details/delete/{id}', [App\Http\Controllers\settings\BankDetailsController::class, 'deleteBankDetails'])->name('delete');
});


// Routes for Settings / Countries
// Route::group(['middleware' => ['auth', 'permission:access-countries']], function() {
    Route::get('/settings/countries', [App\Http\Controllers\settings\CountriesController::class, 'index'])->name('countries');
    Route::get('/settings/countries/list', [App\Http\Controllers\settings\CountriesController::class, 'listCountries'])->name('list');
    Route::get('/settings/countries/fetch-countries/{id}', [App\Http\Controllers\settings\CountriesController::class, 'fetchCountries']);
// });

// Route::group(['middleware' => ['auth', 'permission:modify-countries']], function() {
    Route::get('/settings/countries/create-countries', [App\Http\Controllers\settings\CountriesController::class, 'createCountries']);
    Route::post('/settings/countries/create', [App\Http\Controllers\settings\CountriesController::class, 'insertCountriesData']);
    Route::post('/settings/countries/update', [App\Http\Controllers\settings\CountriesController::class, 'updateCountriesData']);
    Route::get('/settings/countries/edit-countries/{id}', [App\Http\Controllers\settings\CountriesController::class, 'editCountries']);
    Route::delete('/settings/countries/delete/{id}', [App\Http\Controllers\settings\CountriesController::class, 'deleteCountries'])->name('delete');
// });



// Routes for Settings / States
// Route::group(['middleware' => ['auth', 'permission:access-states']], function() {
    Route::get('/settings/states', [App\Http\Controllers\settings\StatesController::class, 'index'])->name('states');
    Route::get('/settings/states/list', [App\Http\Controllers\settings\StatesController::class, 'listStates'])->name('list');
    Route::get('/settings/states/list-country', [App\Http\Controllers\settings\StatesController::class, 'listCountries'])->name('list-country');
    Route::get('/settings/states/fetch-states/{id}', [App\Http\Controllers\settings\StatesController::class, 'fetchStates']);
// });

// Route::group(['middleware' => ['auth', 'permission:modify-states']], function() {
    Route::get('/settings/states/create-states', [App\Http\Controllers\settings\StatesController::class, 'createStates']);
    Route::post('/settings/states/create', [App\Http\Controllers\settings\StatesController::class, 'insertStatesData']);
    Route::post('/settings/states/update', [App\Http\Controllers\settings\StatesController::class, 'updateStatesData']);
    Route::get('/settings/states/edit-states/{id}', [App\Http\Controllers\settings\StatesController::class, 'editStates']);
    Route::delete('/settings/states/delete/{id}', [App\Http\Controllers\settings\StatesController::class, 'deleteStates'])->name('delete');
// });



// Routes for Settings / Cities
Route::group(['middleware' => ['auth', 'permission:access-cities']], function() {
    Route::get('/settings/cities', [App\Http\Controllers\settings\CitiesController::class, 'index'])->name('cities');
    Route::get('/settings/cities/list', [App\Http\Controllers\settings\CitiesController::class, 'listCities'])->name('list');
    Route::get('/settings/cities/list-country', [App\Http\Controllers\settings\CitiesController::class, 'listCountries'])->name('list-country');
    Route::get('/settings/cities/list-state', [App\Http\Controllers\settings\CitiesController::class, 'listState'])->name('list-state');
    Route::get('/settings/cities/list-state-id/{id}', [App\Http\Controllers\settings\CitiesController::class, 'listStateByCountryId'])->name('list-state-id');
    Route::get('/settings/cities/list-city-id/{id}', [App\Http\Controllers\settings\CitiesController::class, 'listCityByStateId'])->name('list-city-id');
    Route::get('/settings/cities/fetch-cities/{id}', [App\Http\Controllers\settings\CitiesController::class, 'fetchCities']);
});

Route::group(['middleware' => ['auth', 'permission:modify-cities']], function() {
    Route::get('/settings/cities/create-cities', [App\Http\Controllers\settings\CitiesController::class, 'createCities']);
    Route::post('/settings/cities/create', [App\Http\Controllers\settings\CitiesController::class, 'insertCitiesData']);
    Route::post('/settings/cities/update', [App\Http\Controllers\settings\CitiesController::class, 'updateCitiesData']);
    Route::get('/settings/cities/edit-cities/{id}', [App\Http\Controllers\settings\CitiesController::class, 'editCities']);
    Route::delete('/settings/cities/delete/{id}', [App\Http\Controllers\settings\CitiesController::class, 'deleteCities'])->name('delete');
});


// Routes for Settings / Transport Details
Route::group(['middleware' => ['auth', 'permission:access-transport']], function() {
    Route::get('/settings/transport-details', [App\Http\Controllers\settings\TransportDetailsController::class, 'index'])->name('transport-details');
    Route::get('/settings/transport-details/list', [App\Http\Controllers\settings\TransportDetailsController::class, 'listTransportDetails'])->name('list');
    Route::get('/settings/transport-details/fetch-transport-details/{id}', [App\Http\Controllers\settings\TransportDetailsController::class, 'fetchTransportDetails']);
});

Route::group(['middleware' => ['auth', 'permission:modify-transport']], function() {
    Route::get('/settings/transport-details/create-transport-details', [App\Http\Controllers\settings\TransportDetailsController::class, 'createTransportDetails']);
    Route::post('/settings/transport-details/create', [App\Http\Controllers\settings\TransportDetailsController::class, 'insertTransportDetailsData']);
    Route::post('/settings/transport-details/update', [App\Http\Controllers\settings\TransportDetailsController::class, 'updateTransportDetailsData']);
    Route::get('/settings/transport-details/edit-transport-details/{id}', [App\Http\Controllers\settings\TransportDetailsController::class, 'editTransportDetails']);
    Route::delete('/settings/transport-details/delete/{id}', [App\Http\Controllers\settings\TransportDetailsController::class, 'deleteTransportDetails'])->name('delete');
});


// Routes for Settings / Type of Address
Route::group(['middleware' => ['auth', 'permission:access-type-of-address']], function() {
    Route::get('/settings/type-of-address', [App\Http\Controllers\settings\TypeOfAddressController::class, 'index'])->name('type-of-address');
    Route::get('/settings/type-of-address/list', [App\Http\Controllers\settings\TypeOfAddressController::class, 'listTypeOfAddress'])->name('list');
    Route::get('/settings/type-of-address/fetch-type-of-address/{id}', [App\Http\Controllers\settings\TypeOfAddressController::class, 'fetchTypeOfAddress']);
});

Route::group(['middleware' => ['auth', 'permission:modify-type-of-address']], function() {
    Route::get('/settings/type-of-address/create-type-of-address', [App\Http\Controllers\settings\TypeOfAddressController::class, 'createTypeOfAddress']);
    Route::post('/settings/type-of-address/create', [App\Http\Controllers\settings\TypeOfAddressController::class, 'insertTypeOfAddressData']);
    Route::post('/settings/type-of-address/update', [App\Http\Controllers\settings\TypeOfAddressController::class, 'updateTypeOfAddressData']);
    Route::get('/settings/type-of-address/edit-type-of-address/{id}', [App\Http\Controllers\settings\TypeOfAddressController::class, 'editTypeOfAddress']);
    Route::delete('/settings/type-of-address/delete/{id}', [App\Http\Controllers\settings\TypeOfAddressController::class, 'deleteTypeOfAddress'])->name('delete');
});


// Routes for Settings / Default Settings
Route::group(['middleware' => ['auth', 'permission:access-default-settings']], function() {
    Route::get('/settings/default-settings', [App\Http\Controllers\settings\DefaultSettingsController::class, 'index'])->name('default-settings');
    Route::get('/settings/default-settings/fetch-default-settings/{id}', [App\Http\Controllers\settings\DefaultSettingsController::class, 'fetchDefaultSettings']);
});

Route::group(['middleware' => ['auth', 'permission:modify-default-settings']], function() {
    Route::post('/settings/default-settings/update', [App\Http\Controllers\settings\DefaultSettingsController::class, 'updateDefaultSettingsData']);
    Route::get('/settings/default-settings/edit-default-settings/{id}', [App\Http\Controllers\settings\DefaultSettingsController::class, 'editDefaultSettings']);
});


// Routes for Settings / Designation
Route::group(['middleware' => ['auth', 'permission:access-designation']], function() {
    Route::get('/settings/designation', [App\Http\Controllers\settings\DesignationController::class, 'index'])->name('designation');
    Route::get('/settings/designation/list', [App\Http\Controllers\settings\DesignationController::class, 'listDesignation'])->name('list');
    Route::get('/settings/designation/fetch-designation/{id}', [App\Http\Controllers\settings\DesignationController::class, 'fetchDesignation']);
});

Route::group(['middleware' => ['auth', 'permission:modify-designation']], function() {
    Route::get('/settings/designation/create-designation', [App\Http\Controllers\settings\DesignationController::class, 'createDesignation']);
    Route::post('/settings/designation/create', [App\Http\Controllers\settings\DesignationController::class, 'insertDesignationData']);
    Route::post('/settings/designation/update', [App\Http\Controllers\settings\DesignationController::class, 'updateDesignationData']);
    Route::get('/settings/designation/edit-designation/{id}', [App\Http\Controllers\settings\DesignationController::class, 'editDesignation']);
    Route::delete('/settings/designation/delete/{id}', [App\Http\Controllers\settings\DesignationController::class, 'deleteDesignation'])->name('delete');
});


// Routes for Settings / SMS Settings
Route::group(['middleware' => ['auth', 'permission:access-sms-settings']], function() {
    Route::get('/settings/sms-settings', [App\Http\Controllers\settings\SmsSettingsController::class, 'index'])->name('sms-settings');
    Route::get('/settings/sms-settings/list-designation', [App\Http\Controllers\settings\SmsSettingsController::class, 'listDesignation'])->name('list-designation');
    Route::get('/settings/sms-settings/fetch-sms-settings/{id}', [App\Http\Controllers\settings\SmsSettingsController::class, 'fetchSmsSettings']);
});

Route::group(['middleware' => ['auth', 'permission:modify-sms-settings']], function() {
    Route::post('/settings/sms-settings/update', [App\Http\Controllers\settings\SmsSettingsController::class, 'updateSmsSettingsData']);
    Route::get('/settings/sms-settings/edit-sms-settings/{id}', [App\Http\Controllers\settings\SmsSettingsController::class, 'editSmsSettings']);
});


// Routes for Settings / Agent
Route::group(['middleware' => ['auth', 'permission:access-agent']], function() {
    Route::get('/settings/agent', [App\Http\Controllers\settings\AgentController::class, 'index'])->name('agent');
    Route::get('/settings/agent/list', [App\Http\Controllers\settings\AgentController::class, 'listAgent'])->name('list');
    Route::get('/settings/agent/fetch-agent/{id}', [App\Http\Controllers\settings\AgentController::class, 'fetchAgent']);
});

Route::group(['middleware' => ['auth', 'permission:modify-agent']], function() {
    Route::get('/settings/agent/create-agent', [App\Http\Controllers\settings\AgentController::class, 'createAgent']);
    Route::post('/settings/agent/create', [App\Http\Controllers\settings\AgentController::class, 'insertAgentData']);
    Route::post('/settings/agent/update', [App\Http\Controllers\settings\AgentController::class, 'updateAgentData']);
    Route::get('/settings/agent/edit-agent/{id}', [App\Http\Controllers\settings\AgentController::class, 'editAgent']);
    Route::delete('/settings/agent/delete/{id}', [App\Http\Controllers\settings\AgentController::class, 'deleteAgent'])->name('delete');
});


// Routes for Settings / Sale Bill Agent
Route::group(['middleware' => ['auth', 'permission:access-sale-bill-agent']], function() {
    Route::get('/settings/sale-bill-agent', [App\Http\Controllers\settings\SaleBillAgentController::class, 'index'])->name('sale-bill-agent');
    Route::get('/settings/sale-bill-agent/list', [App\Http\Controllers\settings\SaleBillAgentController::class, 'listSaleBillAgent'])->name('list');
    Route::get('/settings/sale-bill-agent/fetch-sale-bill-agent/{id}', [App\Http\Controllers\settings\SaleBillAgentController::class, 'fetchSaleBillAgent']);
});

Route::group(['middleware' => ['auth', 'permission:modify-sale-bill-agent']], function() {
    Route::get('/settings/sale-bill-agent/create-sale-bill-agent', [App\Http\Controllers\settings\SaleBillAgentController::class, 'createSaleBillAgent']);
    Route::post('/settings/sale-bill-agent/create', [App\Http\Controllers\settings\SaleBillAgentController::class, 'insertSaleBillAgentData']);
    Route::post('/settings/sale-bill-agent/update', [App\Http\Controllers\settings\SaleBillAgentController::class, 'updateSaleBillAgentData']);
    Route::get('/settings/sale-bill-agent/edit-sale-bill-agent/{id}', [App\Http\Controllers\settings\SaleBillAgentController::class, 'editSaleBillAgent']);
    Route::delete('/settings/sale-bill-agent/delete/{id}', [App\Http\Controllers\settings\SaleBillAgentController::class, 'deleteSaleBillAgent'])->name('delete');
});


// Routes for Settings / Fabric
Route::group(['middleware' => ['auth', 'permission:access-fabric-group']], function() {
    Route::get('/settings/fabricGroup', [App\Http\Controllers\settings\FabricGroupController::class, 'index'])->name('fabricGroup');
    Route::get('/settings/fabricGroup/list', [App\Http\Controllers\settings\FabricGroupController::class, 'listFabricGroup'])->name('list');
    Route::get('/settings/fabricGroup/fetch-fabricGroup/{id}', [App\Http\Controllers\settings\FabricGroupController::class, 'fetchFabricGroup']);
});

Route::group(['middleware' => ['auth', 'permission:modify-fabricGroup']], function() {
    Route::get('/settings/fabricGroup/create-fabricGroup', [App\Http\Controllers\settings\FabricGroupController::class, 'createFabricGroup']);
    Route::post('/settings/fabricGroup/create', [App\Http\Controllers\settings\FabricGroupController::class, 'insertFabricGroupData']);
    Route::post('/settings/fabricGroup/update', [App\Http\Controllers\settings\FabricGroupController::class, 'updateFabricGroupData']);
    Route::get('/settings/fabricGroup/edit-fabricGroup/{id}', [App\Http\Controllers\settings\FabricGroupController::class, 'editFabricGroup']);
    Route::delete('/settings/fabricGroup/delete/{id}', [App\Http\Controllers\settings\FabricGroupController::class, 'deleteFabricGroup'])->name('delete');
});


// Routes for Settings / Company Type
Route::group(['middleware' => ['auth', 'permission:access-companytype']], function() {
    Route::get('/settings/companyType', [App\Http\Controllers\settings\CompanyTypeController::class, 'index'])->name('companyType');
    Route::get('/settings/companyType/list', [App\Http\Controllers\settings\CompanyTypeController::class, 'listCompanyType'])->name('list');
    Route::get('/settings/companyType/fetch-companyType/{id}', [App\Http\Controllers\settings\CompanyTypeController::class, 'fetchCompanyType']);
});

Route::group(['middleware' => ['auth', 'permission:modify-companytype']], function() {
    Route::get('/settings/companyType/create-companyType', [App\Http\Controllers\settings\CompanyTypeController::class, 'createCompanyType']);
    Route::post('/settings/companyType/create', [App\Http\Controllers\settings\CompanyTypeController::class, 'insertCompanyTypeData']);
    Route::post('/settings/companyType/update', [App\Http\Controllers\settings\CompanyTypeController::class, 'updateCompanyTypeData']);
    Route::get('/settings/companyType/edit-companyType/{id}', [App\Http\Controllers\settings\CompanyTypeController::class, 'editCompanyType']);
    Route::delete('/settings/companyType/delete/{id}', [App\Http\Controllers\settings\CompanyTypeController::class, 'deleteCompanyType'])->name('delete');
});


// Routes for Settings / Permissions
Route::group(['middleware' => ['auth', 'permission:access-permission']], function() {
    Route::get('/settings/permission', [App\Http\Controllers\settings\PermissionController::class, 'index'])->name('permission');
    Route::get('/settings/permission/list', [App\Http\Controllers\settings\PermissionController::class, 'listPermission'])->name('list');
    Route::get('/settings/permission/fetch-permission/{id}', [App\Http\Controllers\settings\PermissionController::class, 'fetchPermission']);
});

Route::group(['middleware' => ['auth', 'permission:modify-permission']], function() {
    Route::get('/settings/permission/create-permission', [App\Http\Controllers\settings\PermissionController::class, 'createPermission']);
    Route::post('/settings/permission/create', [App\Http\Controllers\settings\PermissionController::class, 'insertPermissionData']);
    Route::post('/settings/permission/update', [App\Http\Controllers\settings\PermissionController::class, 'updatePermissionData']);
    Route::get('/settings/permission/edit-permission/{id}', [App\Http\Controllers\settings\PermissionController::class, 'editPermission']);
    Route::delete('/settings/permission/delete/{id}', [App\Http\Controllers\settings\PermissionController::class, 'deletePermission'])->name('delete');
});

// Route::get('/settings/connections', [App\Http\Controllers\settings\ConnectionController::class, 'index'])->name('connections');