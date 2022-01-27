<template>    
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 v-if="scope == 'edit'" class="nk-block-title page-title">Edit Company</h3>
                                <h3 v-else class="nk-block-title page-title">Add Company</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Please fill the all details.</p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <form action="#" @submit.prevent="register()">
                                    <input type="hidden" v-if="scope == 'edit'" id="fv-group-id" v-model="company.id">
                                    <div class="preview-block">
                                        <span class="preview-title-lg overline-title">Company Details</span>
                                        <div class="row gy-4">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fw-company_name">Company Name</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="company.company_name" type="text" class="form-control" id="fw-company_name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fw-company_type">Company Type</label>
                                                    <div>
                                                        <select v-model="company.company_type" class="form-control" id="fv-company_type" data-placeholder="Select a option">
                                                            <option>Select Company Type</option>
                                                            <option value="1">General</option>
                                                            <option value="2">Customer</option>
                                                            <option value="3">Supplier</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="fw-company_country">Country</label>
                                                    <div>
                                                        <select v-model="company.company_country" class="form-control" id="fv-company_country" data-placeholder="Select a option">
                                                            <option v-for="country in countryList" :key="country.id" :value="country.id">{{country.name}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="fw-company_state">State</label>
                                                    <div>
                                                        <select v-model="company.company_state" class="form-control" id="fv-company_state" data-placeholder="Select a option">
                                                            <option v-for="state in stateList" :key="state.id" :value="state.id">{{state.name}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group code-block">
                                                    <label class="form-label" for="fw-company_city">City</label>
                                                    <button type="button" class="btn btn-sm clipboard-init" data-toggle="modal" data-target="#addCity" title="Add new city"><span class="clipboard-text">Add New</span></button>
                                                    <div>
                                                        <select v-model="company.company_city" class="form-control" id="fv-company_city" data-placeholder="Select a option">
                                                            <option v-for="city in cityList" :key="city.id" :value="city.id">{{city.name}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="preview-hr">
                                        <div class="row gy-4">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="fw-company_website">Website</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="company.company_website" type="text" class="form-control" id="fw-company_website">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="fw-company_landline">Landline</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="company.company_landline" type="text" class="form-control" id="fw-company_landline">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="fw-company_mobile">Mobile Number</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="company.company_mobile" type="text" class="form-control" id="fw-company_mobile">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-remark_watchout">Remark Watchout</label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control" id="fv-remark_watchout" v-model="company.company_remark_watchout"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-company_about">About Company</label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control" id="fv-company_about" v-model="company.company_about"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="preview-hr">
                                        <div class="row gy-4">
                                            <div class="col-md-2">
                                                <div class="preview-block">
                                                    <label class="form-label">Watchout</label>
                                                    <ul class="custom-control-group g-3 align-center">
                                                        <li>
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" class="custom-control-input" v-model="company.company_watchout" id="fv-company_watchout_yes" value="1" >
                                                                <label class="custom-control-label" for="fv-company_watchout_yes">Yes</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" class="custom-control-input" v-model="company.company_watchout" id="fv-company_watchout_no" value="0" >
                                                                <label class="custom-control-label" for="fv-company_watchout_no">No</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="fw-company_category">Company Category</label>
                                                    <div>
                                                        <select v-model="company.company_category" class="form-control" id="fv-company_category" data-placeholder="Select a option">
                                                            <option v-for="category in companyCategoryList" :key="category.id" :value="category.id">{{category.category_name}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group code-block">
                                                    <label class="form-label" for="fw-company_transport">Transport</label>
                                                        <button type="button" class="btn btn-sm clipboard-init" data-toggle="modal" data-target="#addTransport" title="Add new transport"><span class="clipboard-text">Add New</span></button>
                                                    <div>
                                                        <select v-model="company.company_transport" class="form-control" id="fv-company_transport" data-placeholder="Select a option">
                                                            <option v-for="transport in transportList" :key="transport.id" :value="transport.id">{{transport.name}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="fw-company_discount">Discount</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="company.company_discount" type="text" class="form-control" id="fw-company_discount">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="fw-company_payment_terms_in_days">Payment Terms (Days)</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="company.company_payment_terms_in_days" type="text" class="form-control" id="fw-company_payment_terms_in_days">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="fw-company_opening_balance">Opening Balance</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="company.company_opening_balance" type="text" class="form-control" id="fw-company_opening_balance">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="preview-hr">
                                        <div class="row gy-4">
                                            <div class="col-md-12 d-flex align-items-center">
                                                <span class="preview-title-lg overline-title d-inline-block w-100">Contact Details</span>
                                                <li class="dropdown-toggle btn btn-icon btn-primary" @click="addContactDetailsRow"><em class="icon ni ni-plus"></em></li>
                                            </div>
                                        </div>
                                        <div class="row gy-4" v-for="(contactDetail, index) in contactDetails" :key="index">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="fw-contact_person_name">Name</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="contactDetail.contact_person_name" type="text" class="form-control" id="fw-contact_person_name" name="fw-contact_person_name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="fw-contact_person_designation">Designation</label>
                                                    <div>
                                                        <select v-model="contactDetail.contact_person_designation" class="form-control" id="fv-contact_person_designation" data-placeholder="Select a option">
                                                            <option v-for="designation in designationList" :key="designation.id" :value="designation.id">{{designation.name}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="form-label" :for="'fw-contact_person_profile_pic'+index">Photo</label>
                                                    <div class="form-control-wrap">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" :id="'fv-contact_person_profile_pic'+index" @change="uploadContactPersonProfilePic(index, $event)">
                                                            <label class="custom-file-label" :for="'fv-contact_person_profile_pic'+index">Choose photo</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="fw-contact_person_mobile">Mobile</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="contactDetail.contact_person_mobile" type="text" class="form-control" id="fw-contact_person_mobile" name="fw-contact_person_mobile">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="fw-contact_person_email">Email</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="contactDetail.contact_person_email" type="text" class="form-control" id="fw-contact_person_email" name="fw-contact_person_email">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 d-flex align-items-center flex-row-reverse">
                                                <li class="dropdown-toggle btn btn-icon btn-primary" @click="deleteContactDetailsRow(contactDetail)"><em class="icon ni ni-cross"></em></li>
                                            </div>
                                        </div>
                                        <hr class="preview-hr">                                        
                                        <div class="row gy-4">
                                            <div class="col-md-12 d-flex align-items-center">
                                                <span class="preview-title-lg overline-title d-inline-block w-100">Multiple Addresses</span>
                                                <li class="dropdown-toggle btn btn-icon btn-primary" @click="addMultipleAddressesRow"><em class="icon ni ni-plus"></em></li>
                                            </div>
                                        </div>
                                        <div v-for="(multipleAddress, index) in multipleAddresses" :key="index">
                                            <div class="row gy-4">
                                                <div class="col-md-3">
                                                    <div class="form-group code-block">
                                                        <label class="form-label" for="fw-ma_address_type">Type of Address</label>
                                                        <button type="button" class="btn btn-sm clipboard-init" data-toggle="modal" data-target="#addTypeOffAddress" title="Add new type of address"><span class="clipboard-text">Add New</span></button>
                                                        <div>
                                                            <select v-model="multipleAddress.address_type" class="form-control" id="fv-ma_address_type" data-placeholder="Select a option">
                                                                <option v-for="address in typeOfAddress" :key="address.id" :value="address.id">{{address.name}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="fw-ma_mobile">Mobile</label>
                                                        <div class="form-control-wrap" style="position: relative; width: 100%;">
                                                            <input v-model="multipleAddress.country_code" type="text" placeholder="+91" class="form-control" id="fv-company_country_code">
                                                            <input v-model="multipleAddress.mobile" type="text" class="form-control" id="fw-ma_mobile">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label class="form-label" for="fv-ma_address">Address</label>
                                                        <div class="form-control-wrap">
                                                            <textarea class="form-control" style="min-height: 0" id="fv-ma_address" v-model="multipleAddress.address"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 d-flex align-items-center flex-row-reverse">
                                                    <li class="dropdown-toggle btn btn-icon btn-primary" @click="deleteMultipleAddressesRow(multipleAddress)"><em class="icon ni ni-cross"></em></li>
                                                </div>
                                            </div>
                                            <div class="row gy-4">
                                                <div class="col-md-12 d-flex align-items-center">
                                                    <span class="preview-title-lg overline-title d-inline-block w-100"></span>
                                                    <li class="dropdown-toggle btn btn-icon btn-primary" @click="addMultipleAddressOwnersRow(multipleAddress)"><em class="icon ni ni-plus"></em></li>
                                                </div>
                                            </div>
                                            <div class="row gy-4" v-for="(multipleAddressesOwner, key) in multipleAddress.multipleAddressesOwners" :key="key">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="fw-mao_name">Name</label>
                                                        <div class="form-control-wrap">
                                                            <input v-model="multipleAddressesOwner.name" type="text" class="form-control" id="fw-mao_name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="form-label" for="fw-maodesignation">Designation</label>
                                                        <div>
                                                            <select v-model="multipleAddressesOwner.designation" class="form-control" id="fv-maodesignation" data-placeholder="Select a option">
                                                                <option v-for="designation in designationList" :key="designation.id" :value="designation.id">{{designation.name}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="form-label" for="fw-mao_profile_pic">Photo</label>
                                                        <div class="form-control-wrap">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" :id="'fv-mao_profile_pic'+index" @change="uploadMultipleAddressOwnerPic(index, key, $event)">
                                                                <label class="custom-file-label" :for="'fv-mao_profile_pic'+index">Choose photo</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="form-label" for="fw-mao_mobile">Mobile</label>
                                                        <div class="form-control-wrap">
                                                            <input v-model="multipleAddressesOwner.mobile" type="text" class="form-control" id="fw-mao_mobile">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="form-label" for="fw-mao_email">Email</label>
                                                        <div class="form-control-wrap">
                                                            <input v-model="multipleAddressesOwner.email" type="text" class="form-control" id="fw-mao_email" name="fw-mao_email">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 d-flex align-items-center flex-row-reverse">
                                                    <li class="dropdown-toggle btn btn-icon btn-primary" @click="deleteMultipleAddressesOwnersRow(multipleAddress, multipleAddressesOwner)"><em class="icon ni ni-cross"></em></li>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="preview-hr">
                                        <div class="row gy-4">
                                            <div class="col-md-12 d-flex align-items-center">
                                                <span class="preview-title-lg overline-title d-inline-block w-100">Multiple Emails</span>
                                                <li class="dropdown-toggle btn btn-icon btn-primary" @click="addMultipleEmailsRow"><em class="icon ni ni-plus"></em></li>
                                            </div>
                                        </div>
                                        <div class="row gy-4" v-for="(multipleEmail, index) in multipleEmails" :key="index">
                                            <div class="col-md-11">
                                                <div class="form-group">
                                                    <label class="form-label" for="fw-company_person_name">Email Id</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="multipleEmail.email_id" type="text" class="form-control" id="fw-company_person_name" name="fw-company_person_name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 d-flex align-items-center flex-row-reverse">
                                                <li class="dropdown-toggle btn btn-icon btn-primary" @click="deleteMultipleEmailsRow(multipleEmail)"><em class="icon ni ni-cross"></em></li>
                                            </div>
                                        </div>
                                        <hr class="preview-hr">
                                        <span class="preview-title-lg overline-title">SWOT Details</span>
                                        <div class="row gy-4">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="fw-strength">Strength</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="swot.strength" type="text" class="form-control" id="fw-strength" name="fw-strength">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="fw-weakness">Weakness</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="swot.weakness" type="text" class="form-control" id="fw-weakness" name="fw-weakness">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="fw-opportunity">Oppotunity</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="swot.opportunity" type="text" class="form-control" id="fw-opportunity" name="fw-opportunity">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="fw-threat">Threat</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="swot.threat" type="text" class="form-control" id="fw-threat" name="fw-threat">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="preview-hr">
                                        <span class="preview-title-lg overline-title">References Details</span>
                                        <div class="row gy-4">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="fw-ref_person_name">Reference Person Name</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="references.ref_person_name" type="text" class="form-control" id="fw-ref_person_name" name="fw-ref_person_name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="fw-ref_person_mobile">Mobile No</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="references.ref_person_mobile" type="text" class="form-control" id="fw-ref_person_mobile" name="fw-ref_person_mobile">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="fw-ref_person_company">Company Name</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="references.ref_person_company" type="text" class="form-control" id="fw-ref_person_company" name="fw-ref_person_company">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="fw-ref_person_address">Address</label>
                                                    <div class="form-control-wrap">
                                                        <textarea v-model="references.ref_person_address" type="text" class="form-control" id="fw-ref_person_address" name="fw-ref_person_address" style="min-height: 0"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="preview-hr">
                                        <span class="preview-title-lg overline-title">Packaging Details</span>
                                        <div class="row gy-4">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="fw-gst_no">GST No</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="packaging.gst_no" type="text" class="form-control" id="fw-gst_no" name="fw-gst_no">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="fw-cst_no">CST No</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="packaging.cst_no" type="text" class="form-control" id="fw-cst_no" name="fw-cst_no">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="fw-tin_no">TIN No</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="packaging.tin_no" type="text" class="form-control" id="fw-tin_no" name="fw-tin_no">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="fw-vat_no">VAT No</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="packaging.vat_no" type="text" class="form-control" id="fw-vat_no" name="fw-vat_no">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="preview-hr">
                                        <span class="preview-title-lg overline-title">Bank Details</span>
                                        <div class="row gy-4">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="fw-bank_name">Bank Name</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="bank.bank_name" type="text" class="form-control" id="fw-bank_name" name="fw-bank_name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="fw-account_holder_name">Account Holder Name</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="bank.account_holder_name" type="text" class="form-control" id="fw-account_holder_name" name="fw-account_holder_name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="fw-account_no">Account Number</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="bank.account_no" type="text" class="form-control" id="fw-account_no" name="fw-account_no">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="fw-branch_name">Branch Name</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="bank.branch_name" type="text" class="form-control" id="fw-branch_name" name="fw-branch_name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="fw-ifsc_code">IFSC Code</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="bank.ifsc_code" type="text" class="form-control" id="fw-ifsc_code" name="fw-ifsc_code">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="preview-hr">
                                        <div class="row gy-4">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <a v-bind:href="cancel_url" class="btn btn-dim btn-secondary">Cancel</a>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
        <AddCity></AddCity>
        <AddTransport></AddTransport>
        <AddTypeOfAddress></AddTypeOfAddress>
    </div>
</template>

<script>
    import AddCity from './modal/AddNewCityModelComponent';
    import AddTransport from './modal/AddNewTransportModelComponent';
    import AddTypeOfAddress from './modal/AddNewTypeOfAddressModelComponent';

    var companies = [];
    var countries = [];
    var states = [];
    var cities = [];
    var companyCategories = [];
    var transports = [];
    var designations = [];
    var addresses = [];
    var i = 0, j = 0;
    export default {
        name: 'createCompany',
        components: {
            AddCity,
            AddTransport,
            AddTypeOfAddress
        },
        props: {
            scope: String,
            id: Number,
        },
        data() {
            return {
                cancel_url: '/databank/companies',
                profilePic : [],
                multipleAddressOwnerProfilePic : [],
                companyType: [],
                countryList: [],
                stateList: [],
                cityList: [],
                companyCategoryList: [],
                transportList: [],
                designationList: [],
                typeOfAddress: [],
                showAddCityModal: false,
                companyTypes: [
                    {
                        'id' : 1,
                        'name' : 'General',
                    },
                    {
                        'id' : 2,
                        'name' : 'Customer',
                    },
                    {
                        'id' : 3,
                        'name' : 'Supplier',
                    },
                ],
                company : {
                    id: '',
                    company_name: '',
                    company_type: '',
                    company_country: '',
                    company_state: '',
                    company_city: '',
                    company_website: '',
                    company_landline: '',
                    company_mobile: '',
                    company_watchout: '',
                    company_remark_watchout: '',
                    company_about: '',
                    company_category: '',
                    company_transport: '',
                    company_discount: '',
                    company_payment_terms_in_days: '',
                    company_opening_balance: '',
                },
                contactDetails : [{
                    contact_person_name: '',
                    contact_person_designation: '',
                    contact_person_mobile: '',
                    contact_person_email: '',
                    contact_person_profile_pic: '',
                }],
                multipleAddresses : [{
                    address_type : '',
                    mobile : '',
                    address : '',
                    country_code: '',
                    multipleAddressesOwners : [{
                        name : '',
                        designation : '',
                        mobile : '',
                        email : '',
                        profile_pic : '',
                    }],
                }],
                multipleEmails : [{
                    email_id : ''
                }],
                swot : {
                    strength : '',
                    weakness : '',
                    opportunity : '',
                    threat : '',
                },
                references : {
                    ref_person_name : '',
                    ref_person_mobile : '',
                    ref_person_company : '',
                    ref_person_address : '',
                },
                packaging : {
                    gst_no : '',
                    cst_no : '',
                    tin_no : '',
                    vat_no : '',
                },
                bank : {
                    bank_name : '',
                    account_holder_name : '',
                    account_no : '',
                    branch_name : '',
                    ifsc_code : '',
                },
            }
        },
        created() {
            axios.get('/settings/companyType/list')
            .then(response => {
                this.companyType = response.data;
                console.log(this.companyType);
            });
            axios.get('/settings/cities/list-country')
            .then(response => {
                countries = response.data;
                this.countryList = countries;
            });
            axios.get('/settings/cities/list-state')
            .then(response => {
                states = response.data;
                this.stateList = states;
            });
            axios.get('/settings/cities/list')
            .then(response => {
                cities = response.data;
                this.cityList = cities;
            });
            axios.get('/databank/companyCategory/list')
            .then(response => {
                companyCategories = response.data;
                this.companyCategoryList = companyCategories;
            });
            axios.get('/settings/transport-details/list')
            .then(response => {
                transports = response.data;
                this.transportList   = transports;
            });
            axios.get('/settings/designation/list')
            .then(response => {
                designations = response.data;
                this.designationList = designations;
            });
            axios.get('/settings/type-of-address/list')
            .then(response => {
                addresses = response.data;
                this.typeOfAddress = addresses;
            });
        },
        methods: {
            addContactDetailsRow: function() {
                this.contactDetails.push({
                    contact_person_name: '',
                    contact_person_designation: '',
                    contact_person_mobile: '',
                    contact_person_email: '',
                    contact_person_profile_pic: '',
                });
            },
            deleteContactDetailsRow: function(row) {
                this.contactDetails.pop(row);
            },

            addMultipleAddressesRow: function() {
                this.multipleAddresses.push({
                    address_type : '',
                    mobile : '',
                    address : '',
                    multipleAddressesOwners : [{
                        name : '',
                        designation : '',
                        mobile : '',
                        email : '',
                        profile_pic : '',
                    }],
                });
            },
            deleteMultipleAddressesRow: function(row) {
                this.multipleAddresses.pop(row);
            },

            addMultipleAddressOwnersRow: function(row) {
                row.multipleAddressesOwners.push({
                    name : '',
                    designation : '',
                    mobile : '',
                    email : '',
                        profile_pic : '',
                });
            },
            deleteMultipleAddressesOwnersRow: function(row, subrow) {
                row.multipleAddressesOwners.pop(subrow);
            },
                        
            addMultipleEmailsRow: function() {
                this.multipleEmails.push({
                    email_id: '',
                });
            },
            deleteMultipleEmailsRow: function(row) {
                this.multipleEmails.pop(row);
            },

            uploadContactPersonProfilePic (index, e) {
                this.contactDetails[index]['contact_person_profile_pic'] = e.target.files[0];
            },
            uploadMultipleAddressOwnerPic (index, key, e) {
                this.multipleAddresses[index].multipleAddressesOwners[key]['profile_pic'] = e.target.files[0];
            },

            register () {
                var formData = new FormData();

                formData.append('company_data', JSON.stringify(this.company));
                formData.append('contact_details', JSON.stringify(this.contactDetails));
                formData.append('multiple_addresses', JSON.stringify(this.multipleAddresses));
                formData.append('multiple_emails', JSON.stringify(this.multipleEmails));
                formData.append('swot_details', JSON.stringify(this.swot));
                formData.append('references_details', JSON.stringify(this.references));
                formData.append('packaging_details', JSON.stringify(this.packaging));
                formData.append('bank_details', JSON.stringify(this.bank));  
                
                this.contactDetails.forEach((contact,index)=>{
                    if(contact.contact_person_profile_pic){
                        formData.append(`contact_details_profile_pic[${index}]`, contact.contact_person_profile_pic);
                    }else{
                        formData.append(`contact_details_profile_pic[${index}]`, null);
                    }
                })

                this.multipleAddresses.forEach((multipleAdd,key)=>{
                    multipleAdd.multipleAddressesOwners.forEach((contact,index)=>{
                        if(contact.profile_pic){
                            formData.append(`multiple_address_profile_pic[${key}][ownerImage][${index}]`, contact.profile_pic);
                        }else{
                            formData.append(`multiple_address_profile_pic[${key}][ownerImage][${index}]`, null);
                        }
                    })
                })
                console.log("FORM:- ", formData);
                if (this.scope == 'edit') {
                    axios.post('/databank/companies/update', formData)
                    .then(response => {
                        window.location.href = '/databank/companies';
                    });
                } else {
                    axios.post('/databank/companies/create', formData)
                    .then(response => {
                        window.location.href = '/databank/companies';
                    });
                }
            },
        },
        mounted() {
            switch (this.scope) {
                case 'edit' :
                    axios.get(`/databank/companies/fetch-company/${this.id}`)
                    .then(response => {
                        companies = response.data;
                        console.log(companies);
                        // company Data
                        this.company = companies.company;

                        // Contacts Data
                        this.contactDetails = companies.contact_details;
                        
                        // Multiple Address
                        this.multipleAddresses = companies.multiple_address;
                        
                        // Multiple Emails
                        this.multipleEmails = companies.multiple_emails;
                        
                        // SWOT
                        this.swot = companies.swot_details;
                        
                        // Packaging
                        this.packaging = companies.packaging_details;
                        
                        // References
                        this.references = companies.references_details;
                        
                        // Bank
                        this.bank = companies.bank_details;
                    });
                    break;
                default:
                    break;
            }
        },
    };
</script>
<style>
    .form-group.code-block {
        border: none;
        padding: 0;
    }
    .form-group.code-block .clipboard-init {
        top: -5px;
        color: #6576ff;
    }
    .form-group.code-block .clipboard-init:hover {
        border-color: #6576ff;
    }
    #fv-company_country_code {
        position: absolute;
        width: 20%;
        padding-left: 10px;
    }
    #fw-ma_mobile {
        width: 77%;
        float: right;
    }
</style>