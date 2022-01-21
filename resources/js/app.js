
import Vue from 'vue';
import Form from 'vform';
// import VuejsDatatableFactory from 'vuejs-datatable';
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
window.Form = Form;
// Vue.use( VuejsDatatableFactory );

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('dashboard-component', require('./components/DashboardComponent.vue').default);

Vue.component('user-group-component', require('./components/databank/userGroupComponents/UserGroupComponent.vue').default);
Vue.component('create-user-group-component', require('./components/databank/userGroupComponents/CreateUserGroupComponent.vue').default);

Vue.component('employee-component', require('./components/databank/employeeComponents/EmployeeComponent.vue').default);
Vue.component('create-employee-component', require('./components/databank/employeeComponents/CreateEmployeeComponent.vue').default);

Vue.component('logs-component', require('./components/LogsComponent.vue').default);

Vue.component('product-category-component', require('./components/databank/productCategoryComponents/ProductCategoryComponent.vue').default);
Vue.component('create-product-category-component', require('./components/databank/productCategoryComponents/CreateProductCategoryComponent.vue').default);

Vue.component('product-sub-category-component', require('./components/databank/productSubCategoryComponents/ProductSubCategoryComponent.vue').default);
Vue.component('create-product-sub-category-component', require('./components/databank/productSubCategoryComponents/CreateProductSubCategoryComponent.vue').default);

Vue.component('company-category-component', require('./components/databank/companyCategoryComponents/CompanyCategoryComponent.vue').default);
Vue.component('create-company-category-component', require('./components/databank/companyCategoryComponents/CreateCompanyCategoryComponent.vue').default);

Vue.component('company-component', require('./components/databank/companyComponents/CompanyComponent.vue').default);
Vue.component('create-company-component', require('./components/databank/companyComponents/CreateCompanyComponent.vue').default);
Vue.component('view-company-component', require('./components/databank/companyComponents/ViewCompanyComponent.vue').default);

Vue.component('link-companies-component', require('./components/databank/linkCompaniesComponents/LinkCompaniesComponent.vue').default);
Vue.component('create-link-companies-component', require('./components/databank/linkCompaniesComponents/CreateLinkCompaniesComponent.vue').default);

Vue.component('product-component', require('./components/databank/productsComponents/ProductComponent.vue').default);
Vue.component('create-product-component', require('./components/databank/productsComponents/CreateProductComponent.vue').default);



Vue.component('agent-component', require('./components/settings/agentComponents/AgentComponent.vue').default);
Vue.component('create-agent-component', require('./components/settings/agentComponents/CreateAgentComponent.vue').default);

Vue.component('bank-details-component', require('./components/settings/bankDetailsComponents/BankDetailsComponent.vue').default);
Vue.component('create-bank-details-component', require('./components/settings/bankDetailsComponents/CreateBankDetailsComponent.vue').default);

Vue.component('countries-component', require('./components/settings/countriesComponents/CountriesComponent.vue').default);
Vue.component('create-countries-component', require('./components/settings/countriesComponents/CreateCountriesComponent.vue').default);

Vue.component('states-component', require('./components/settings/statesComponents/StatesComponent.vue').default);
Vue.component('create-states-component', require('./components/settings/statesComponents/CreateStatesComponent.vue').default);

Vue.component('cities-component', require('./components/settings/citiesComponents/CitiesComponent.vue').default);
Vue.component('create-cities-component', require('./components/settings/citiesComponents/CreateCitiesComponent.vue').default);

Vue.component('create-default-settings-component', require('./components/settings/defaultSettingsComponents/CreateDefaultSettingsComponent.vue').default);

Vue.component('designation-component', require('./components/settings/designationComponents/DesignationComponent.vue').default);
Vue.component('create-designation-component', require('./components/settings/designationComponents/CreateDesignationComponent.vue').default);

Vue.component('sale-bill-agent-component', require('./components/settings/saleBillAgentComponents/SaleBillAgentComponent.vue').default);
Vue.component('create-sale-bill-agent-component', require('./components/settings/saleBillAgentComponents/CreateSaleBillAgentComponent.vue').default);

Vue.component('sms-settings-component', require('./components/settings/smsSettingsComponents/SmsSettingsComponent.vue').default);
Vue.component('create-sms-settings-component', require('./components/settings/smsSettingsComponents/CreateSmsSettingsComponent.vue').default);

Vue.component('transport-details-component', require('./components/settings/transportDetailsComponents/TransportDetailsComponent.vue').default);
Vue.component('create-transport-details-component', require('./components/settings/transportDetailsComponents/CreateTransportDetailsComponent.vue').default);

Vue.component('type-of-address-component', require('./components/settings/typeOfAddressComponents/TypeOfAddressComponent.vue').default);
Vue.component('create-type-of-address-component', require('./components/settings/typeOfAddressComponents/CreateTypeOfAddressComponent.vue').default);

Vue.component('fabric-group-component', require('./components/settings/fabricGroupComponents/FabricGroupComponent.vue').default);
Vue.component('create-fabric-group-component', require('./components/settings/fabricGroupComponents/CreateFabricGroupComponent.vue').default);

Vue.component('company-type-component', require('./components/settings/companyTypeComponents/CompanyTypeComponent.vue').default);
Vue.component('create-company-type-component', require('./components/settings/companyTypeComponents/CreateCompanyTypeComponent.vue').default);

Vue.component('permission-component', require('./components/settings/permissionsComponents/PermissionComponent.vue').default);
Vue.component('create-permission-component', require('./components/settings/permissionsComponents/CreatePermissionComponent.vue').default);

/**type-of-address
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
