<template>
    
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 v-if="scope == 'edit'" class="nk-block-title page-title">Edit Employee</h3>
                                <h3 v-else class="nk-block-title page-title">Add Employee</h3>
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
                                    <input type="hidden" v-if="scope == 'edit'" id="fv-group-id" v-model="form.id">
                                    <input type="hidden" id="user_group_id" v-model="form.user_group">
                                    <div class="preview-block">
                                        <span class="preview-title-lg overline-title">Personal Details</span>
                                        <div class="row gy-4">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-first-name">First Name</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="fv-first-name" v-model="form.firstname" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-middle-name">Middle Name</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="fv-middle-name" v-model="form.middlename">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-last-name">Last Name</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="fv-last-name" v-model="form.lastname" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-06">Profile Picture</label>
                                                    <div class="form-control-wrap">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" name="profile_pic" id="fv-profile-pic" @change="uploadProfilePic">
                                                            <label class="custom-file-label" for="fv-profile-pic">Choose photo</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-email-id">Email Id</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="fv-email-id" v-model="form.email_id" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-mobile">Mobile No</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="fv-mobile" v-model="form.mobile" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-address">Address</label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control no-resize" id="fv-address" v-model="form.address"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-user_group">User Group</label>
                                                    <div>
                                                        <multiselect v-model="form.user_group" :options="userGroups" placeholder="Select one" label="name" track-by="name"></multiselect>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-06">ID Proof</label>
                                                    <div class="form-control-wrap">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" name="id_proof" id="fv-id-proof" @change="uploadIdProof">
                                                            <label class="custom-file-label" for="fv-id-proof">Choose photo</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="preview-block">
                                                    <label class="form-label">Excel Access</label>
                                                    <ul class="custom-control-group g-3 align-center">
                                                        <li>
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" class="custom-control-input" name="excel_access" v-model="form.excel_access" id="fv-yes" value="1" >
                                                                <label class="custom-control-label" for="fv-yes">Yes</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" class="custom-control-input" name="excel_access" v-model="form.excel_access" id="fv-no" value="0" >
                                                                <label class="custom-control-label" for="fv-no">No</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div v-if="scope == 'edit'" class="col-md-2">
                                                <div class="preview-block">
                                                    <label class="form-label">Is Active</label>
                                                    <ul class="custom-control-group g-3 align-center">
                                                        <li>
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" class="custom-control-input" name="is_active" v-model="form.is_active" id="fv-active-yes" value="1" >
                                                                <label class="custom-control-label" for="fv-active-yes">Yes</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" class="custom-control-input" name="is_active" v-model="form.is_active" id="fv-active-no" value="0" >
                                                                <label class="custom-control-label" for="fv-active-no">No</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="preview-hr">
                                        <span class="preview-title-lg overline-title">Refrence Person Details</span>
                                        <div class="row gy-4">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-ref-full-name">Ref. Full Name</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="fv-ref-full-name" v-model="form.ref_full_name" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-ref-mobile">Ref. Mobile No</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="fv-ref-mobile" v-model="form.ref_mobile">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-06">Ref. Passport size photo</label>
                                                    <div class="form-control-wrap">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" name="ref_pass_pic" id="fv-ref-pic" @change="uploadRefPassPic">
                                                            <label class="custom-file-label" for="fv-ref-pic">Choose photo</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-ref-address">Description</label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control no-resize" id="fv-ref-address" v-model="form.ref_address"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="preview-hr">
                                        <span class="preview-title-lg overline-title">Login Details</span>
                                        <div class="row gy-4">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-user-name">User Name</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="fv-user-name" v-model="form.username" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div v-if="scope != 'edit'" class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-password">Password</label>
                                                    <div class="form-control-wrap">
                                                        <input type="password" class="form-control" id="fv-password" v-model="form.password" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div v-if="scope != 'edit'" class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-conf-password">Confirm Password</label>
                                                    <div class="form-control-wrap">
                                                        <input type="password" class="form-control" id="fv-conf-password" v-model="form.password_confirmation" required>
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
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect';

    var userGroup = [];
    var gData = [];
    var user_group = '';
    var element = '';
    export default {
        name: 'createUserGroup',
        props: {
            scope: String,
            id: Number,
        },
        components: { 
            Multiselect
        },
        data() {
            return {
                cancel_url: '/databank/employee',
                profilePic: null,
                idProof: null,
                refPassPic: null,
                userGroups: [],
                form: new Form({
                    id: '',
                    firstname: '',
                    middlename: '',
                    lastname: '',
                    email_id: '',
                    mobile: '',
                    address: '',
                    user_group: '',
                    excel_access: '',
                    is_active: '',
                    ref_full_name: '',
                    ref_mobile: '',
                    ref_address: '',
                    username: '',
                    password: '',
                    password_confirmation: '',
                })
            }
        },
        created() {
            axios.get('/databank/users-group/list')
            .then(response => {
                userGroup = response.data;
                this.userGroups = userGroup;
            });
        },
        methods: {
            uploadProfilePic (event) {
                this.profilePic = event.target.files[0];        
            },
            uploadIdProof (event) {
                this.idProof = event.target.files[0];        
            },
            uploadRefPassPic (event) {
                this.refPassPic = event.target.files[0];        
            },
            register () {
                this.form['profile_pic'] = this.profilePic;
                this.form['id_proof'] = this.idProof;
                this.form['ref_pass_pic'] = this.refPassPic;
                element = document.getElementById("user_group_id");
                console.log(element);
                console.log(this.form);
                if (this.scope == 'edit') {
                    this.form.post('/databank/employee/update')
                        .then(() => {
                            window.location.href = '/databank/employee';
                    })
                } else {
                    this.form.post('/databank/employee/create')
                        .then(() => {
                            window.location.href = '/databank/employee';
                    })
                }
            },
        },
        mounted() {
            console.log("This is about component");
            switch (this.scope) {
                case 'edit' :
                    axios.get(`/databank/employee/fetch-employee/${this.id}`)
                    .then(response => {
                        gData = response.data;

                        this.form.id = gData.employee_id;
                        this.form.firstname = gData.firstname;
                        this.form.middlename = gData.middlename;
                        this.form.lastname = gData.lastname;
                        this.form.email_id = gData.email_id;
                        this.form.mobile = gData.mobile;
                        this.form.address = gData.address;
                        this.form.user_group = gData.user_group;
                        this.form.excel_access = gData.excel_access;
                        this.form.is_active = gData.is_active;
                        this.form.ref_full_name = gData.ref_full_name;
                        this.form.ref_mobile = gData.ref_mobile;
                        this.form.ref_address = gData.ref_address;
                        this.form.username = gData.username;
                        this.form.password = gData.password;
                        this.form.password_confirmation = gData.password_confirmation;
                    });
                    break;
                default:
                    break;
            }
        },
    };
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
    .multiselect {
        height: calc(2.125rem + 2px);
        font-family: Roboto,sans-serif;
        font-size: 13px;
        font-weight: 400;
        background-color: #fff;
        border: none;
        border-radius: 4px;
        box-shadow: none;
        transition: all 0.3s;
        min-height: 36px;
        display: inline-flex;
        flex-wrap: wrap;
    }
    .multiselect__tag-icon:after {
        color: #526484;
    }
    .multiselect__tag {
        color: #526484;
        background: #ebeef2;
        font-size: 13px;
        font-family: Roboto,sans-serif;
    }
    .multiselect__tags {
        padding: 7px 16px;
        font-size: 13px;
        min-height: 36px;
        border: 1px solid #dbdfea;
        width: 100%;
    }
    .multiselect__placeholder {
        margin-bottom: 0;
        padding-top: 0;
    }
    .multiselect__select {
        height: calc(2.125rem + 2px);
        position: absolute;
        top: 0;
        right: 0;
        width: calc(2.125rem + 2px);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .multiselect__select:before {
        display: none;
    }
    .multiselect .multiselect__select:after {
        font-family: "Nioicon";
        content: "";
        line-height: 1;
    }
    .multiselect.multiselect--active .multiselect__input, .multiselect__single {
        font-size: 13px;
        padding: 0;
        margin-bottom: 0;
        width: 98% !important;
    }
    .multiselect__content-wrapper {
        border-top: 1px solid #dbdfea;
        padding: 6px;
        top: 36px;
    }
    .multiselect__option--highlight {
        background: #ebeef2;
        border-radius: 4px;
        color: #526484;        
    }
    .multiselect__element {
        margin-bottom: 0.125rem;
    }
    .multiselect__option--highlight:after, .multiselect__option:after {
        display: none;
    }
    .multiselect__option--selected.multiselect__option--highlight {
        background: #f3f3f3;
        color: #35495e;
    }
    .multiselect__option--selected {
        font-weight: 500;
    }
    .multiselect__tags-wrap {
        display: inline-flex;
    }
    .multiselect--above .multiselect__content-wrapper {
        border: 1px solid #e8e8e8;
    }
    .multiselect__tag-icon:focus, .multiselect__tag-icon:hover {
        background: #ebeef2;
    }
    .multiselect__tag-icon:focus:after, .multiselect__tag-icon:hover:after {
        color: #526484;
    }
</style>