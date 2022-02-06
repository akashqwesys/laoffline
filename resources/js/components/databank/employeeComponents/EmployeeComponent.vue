<template>
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Employee Lists</h3>
                                <div class="nk-block-des text-soft">
                                    <p>You have total {{employees.length}} employee.</p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">                                            
                                            <li class="nk-block-tools-opt">
                                                <a v-bind:href="create_employee" class="dropdown-toggle btn btn-icon btn-primary"><em class="icon ni ni-plus"></em></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- .toggle-wrap -->
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="card card-bordered card-stretch">
                            <div class="card-inner">
                                <table id="employee" :class="excelAccess == 1 ? 'datatable-init-export table' : 'datatable-init table'" :data-export-title="excelAccess == 1 ? 'Export' : ''">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>User Group</th>
                                            <th>Web Login</th>
                                            <th>Active</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(employee, index) in employees" :key="index">
                                            <td>{{ index + 1 }}</td>
                                            <td>
                                                <div class="user-card">
                                                    <div class="user-avatar user-avatar-sm bg-warning">
                                                        <img v-if="employee.profile_pic != ''" v-bind:src="getProfilePic(employee.profile_pic)" alt="">
                                                        <span v-if="employee.profile_pic == ''">{{ employee.firstname.charAt(0) }}{{ employee.lastname.charAt(0) }}</span>
                                                    </div>
                                                    <div class="user-name"><span class="tb-lead">{{ employee.firstname }} {{ employee.middlename }} {{ employee.lastname }}</span></div>                                                    
                                                </div>
                                            </td>
                                            <td>{{ employee.email_id }}</td>
                                            <td>{{ employee.mobile }}</td>
                                            <td>{{ employee.name }}</td>
                                            <td>{{ employee.web_login }}</td>
                                            <td v-if="employee.is_active == '1'" ><span class="badge badge-dot badge-dot-xs badge-success">Yes</span></td>
                                            <td v-else ><span class="badge badge-dot badge-dot-xs badge-danger">No</span></td>
                                            <td>
                                                <a href="#" @click="edit_data(employee.employee_id)" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Update"><em class="icon ni ni-edit-alt"></em></a>
                                                <a href="#" @click="delete_data(employee.employee_id)" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Remove"><em class="icon ni ni-trash"></em></a>                                                
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div><!-- .card -->
                        </div>
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: 'employee',
        props: {
            excelAccess: Number,
        },
        data() {
            return {
                employees: [],
                create_employee: 'employee/create-employee',
            }
        },
        created() {
            axios.get('./employee/list')
            .then(response => {
                this.employees = response.data;
            });
        },
        methods: {
            edit_data(id){
                window.location.href = './employee/edit-employee/'+id;
            },
            delete_data(id){
                axios.delete('./employee/delete/'+id)
                .then(response => {                    
                    location.reload();
                });
            },
            getProfilePic(name){
                var profilePic = '/upload/profilePic/' + name;
                
                return profilePic;
            }
        },
        mounted() {
        },
    };
</script>
<style>
    .user-avatar img{
        width: 100%;
    }
</style>