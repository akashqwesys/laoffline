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
                                <table class="datatable-init-export nowrap table" data-export-title="Export">
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
                                                <div class="dropdown">
                                                    <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                        <ul class="link-list-plain">
                                                            <li><a href="#" @click="edit_data(employee.employee_id)"><em class="icon ni ni-edit-alt"></em><span>update</span></a></li>
                                                            <li><a href="#" @click="delete_data(employee.employee_id)"><em class="icon ni ni-trash"></em><span>Remove</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
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
                console.log(this.employees);
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
                return '/upload/profilePic/' + name;
            }
        },
        mounted() {
        },
    };
</script>