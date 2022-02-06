<template>
    <div class="nk-content ">
        <vue-loader v-if="showLoader"></vue-loader>
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Agent Lists</h3>
                                <div class="nk-block-des text-soft">
                                    <p>You have total {{agents.length}} Agent.</p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">                                            
                                            <li class="nk-block-tools-opt">
                                                <a v-bind:href="create_agents" class="dropdown-toggle btn btn-icon btn-primary"><em class="icon ni ni-plus"></em></a>
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
                                <table id="agent" :class="excelAccess == 1 ? 'datatable-init-export table' : 'datatable-init table'" :data-export-title="excelAccess == 1 ? 'Export' : ''">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Pan No</th>
                                            <th>Default</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(agent, index) in agents" :key="index">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ agent.name }}</td>
                                            <td>{{ agent.pan_no }}</td>
                                            <td v-if="agent.default == '1'" ><span class="badge badge-dot badge-dot-xs badge-success">Yes</span></td>
                                            <td v-else ><span class="badge badge-dot badge-dot-xs badge-danger">No</span></td>
                                            <td>
                                                <a href="#" @click="edit_data(agent.id)" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Update"><em class="icon ni ni-edit-alt"></em></a>
                                                <a href="#" @click="delete_data(agent.id)" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Remove"><em class="icon ni ni-trash"></em></a>                                                
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
        name: 'companyCategory',
        props: {
            excelAccess: Number,
        },
        components: { 
            VueLoader,
        },
        data() {
            return {
                agents: [],
                showLoader: false,
                create_agents: 'agent/create-agent',
            }
        },
        created() {
            this.showLoader = true;
            axios.get('./agent/list')
            .then(response => {
                this.agents = response.data;
                this.showLoader = false;
            });
        },
        methods: {
            edit_data(id){
                window.location.href = './agent/edit-agent/'+id;
            },
            delete_data(id){
                axios.delete('./agent/delete/'+id)
                .then(response => {                    
                    location.reload();
                });
            }
        },
        mounted() {
        },
    };
</script>