<template>
    <div class="nk-content ">
        <vue-loader v-if="showLoader"></vue-loader>
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Permissions</h3>
                                <div class="nk-block-des text-soft">
                                    <p>You have total {{permissions.length}} permission.</p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">                                            
                                            <li class="nk-block-tools-opt">
                                                <a v-bind:href="create_company_type" class="dropdown-toggle btn btn-icon btn-primary"><em class="icon ni ni-plus"></em></a>
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
                                <table id="permission" :class="excelAccess == 1 ? 'datatable-init-export table' : 'datatable-init table'" :data-export-title="excelAccess == 1 ? 'Export' : ''">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Category Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(permission, index) in permissions" :key="index">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{getCapitalName(permission.name) }}</td>
                                            <td>
                                                <a href="#" @click="edit_data(permission.id)" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Update"><em class="icon ni ni-edit-alt"></em></a>
                                                <a href="#" @click="delete_data(permission.id)" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Remove"><em class="icon ni ni-trash"></em></a>                                                
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
    import VueLoader from './../../../VueLoader';

    export default {
        name: 'permissions',
        props: {
            excelAccess: Number,
        },
        components: { 
            VueLoader,
        },
        data() {
            return {
                permissions: [],
                showLoader: false,
                create_company_type: 'permission/create-permission',
            }
        },
        created() {
            this.showLoader = true;
            axios.get('./permission/list')
            .then(response => {
                this.permissions = response.data;
                this.showLoader = false;
            });
        },
        methods: {
            getCapitalName(pname) {
                var n = pname.replace(/-/g, " ");
                const arr = n.split(" ");

                for (var i = 0; i < arr.length; i++) {
                    arr[i] = arr[i].charAt(0).toUpperCase() + arr[i].slice(1);
                }

                return arr.join(" ");
            },
            edit_data(id){
                window.location.href = './permission/edit-permission/'+id;
            },
            delete_data(id){
                axios.delete('./permission/delete/'+id)
                .then(response => {                    
                    location.reload();
                });
            }
        },
        mounted() {
        },
    };
</script>