<template>
    <div class="nk-content ">
        <vue-loader v-if="showLoader"></vue-loader>
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Transport Details Lists</h3>
                                <div class="nk-block-des text-soft">
                                    <p>You have total {{transportDetails.length}} transport details.</p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">                                            
                                            <li class="nk-block-tools-opt">
                                                <a v-bind:href="create_company_category" class="dropdown-toggle btn btn-icon btn-primary"><em class="icon ni ni-plus"></em></a>
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
                                <table id="transportDetails" :class="excelAccess == 1 ? 'datatable-init-export table' : 'datatable-init table'" :data-export-title="excelAccess == 1 ? 'Export' : ''">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>GSTIN</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(transportDetail, index) in transportDetails" :key="index">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ transportDetail.name }}</td>
                                            <td>{{ transportDetail.gstin }}</td>
                                            <td>
                                                <a href="#" @click="edit_data(transportDetail.id)" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Update"><em class="icon ni ni-edit-alt"></em></a>
                                                <a href="#" @click="delete_data(transportDetail.id)" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Remove"><em class="icon ni ni-trash"></em></a>                                                
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
        name: 'transportDetails',
        props: {
            excelAccess: Number,
        },
        components: { 
            VueLoader,
        },
        data() {
            return {
                transportDetails: [],
                showLoader: false,
                create_company_category: 'transport-details/create-transport-details',
            }
        },
        created() {
            this.showLoader = true;
            axios.get('./transport-details/list')
            .then(response => {
                this.transportDetails = response.data;
                this.showLoader = false;
            });
        },
        methods: {
            edit_data(id){
                window.location.href = './transport-details/edit-transport-details/'+id;
            },
            delete_data(id){
                axios.delete('./transport-details/delete/'+id)
                .then(response => {                    
                    location.reload();
                });
            }
        },
        mounted() {
        },
    };
</script>