<template>
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Sale Bill Agent Lists</h3>
                                <div class="nk-block-des text-soft">
                                    <p>You have total {{saleBillAgents.length}} sale bill agent.</p>
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
                                <table class="datatable-init-export nowrap table" data-export-title="Export">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Default</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(saleBillAgent, index) in saleBillAgents" :key="index">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ saleBillAgent.name }}</td>
                                            <td v-if="saleBillAgent.default == '1'" ><span class="badge badge-dot badge-dot-xs badge-success">Yes</span></td>
                                            <td v-else ><span class="badge badge-dot badge-dot-xs badge-danger">No</span></td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="#" @click="edit_data(saleBillAgent.id)"><em class="icon ni ni-edit-alt"></em><span>update</span></a></li>
                                                            <li><a href="#" @click="delete_data(saleBillAgent.id)"><em class="icon ni ni-trash"></em><span>Remove</span></a></li>
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
        name: 'saleBillAgent',
        data() {
            return {
                saleBillAgents: [],
                create_company_category: 'sale-bill-agent/create-sale-bill-agent',
            }
        },
        created() {
            axios.get('./sale-bill-agent/list')
            .then(response => {
                this.saleBillAgents = response.data;
                console.log(this.saleBillAgents);
            });
        },
        methods: {
            edit_data(id){
                window.location.href = './sale-bill-agent/edit-sale-bill-agent/'+id;
            },
            delete_data(id){
                axios.delete('./sale-bill-agent/delete/'+id)
                .then(response => {                    
                    location.reload();
                });
            }
        },
        mounted() {
        },
    };
</script>