<template>
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Company Lists</h3>
                                <div class="nk-block-des text-soft">
                                    <p>You have total {{companies.length}} company.</p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">                                            
                                            <li class="nk-block-tools-opt">
                                                <a href="#" class="btn btn-wider btn-primary" @click="getEssentialCompany">Essential Companies</a>
                                            </li>
                                            <li class="nk-block-tools-opt">
                                                <a v-bind:href="create_company" class="dropdown-toggle btn btn-icon btn-primary"><em class="icon ni ni-plus"></em></a>
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
                                <table class="datatable-init-export table" data-export-title="Export">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th></th>
                                            <th></th>
                                            <th>Name</th>
                                            <th>Office No.</th>
                                            <th>Company Type</th>
                                            <th>Company Category</th>
                                            <th>City</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(company, index) in companies" :key="index">
                                            <td>{{ index + 1 }}</td>
                                            <td>
                                                <em v-if="company.favorite_flag == 0" class="icon ni ni-star" @click="isFavorite(company.company_id)"></em>
                                                <em v-else class="icon ni ni-star-fill" @click="isUnFavorite(company.company_id)"></em>
                                            </td>
                                            <td>
                                                <em v-if="company.is_verified == 0" class="icon ni ni-alert-fill"></em>
                                                <em v-else class="icon ni ni-check-thick"></em>
                                            </td>
                                            <td>
                                                <a href="#" @click="view_data(company.company_id)">{{ company.company_name }} </a>
                                            </td>
                                            <td>
                                                <Ul>
                                                    <li><b>L: </b> {{ company.company_landline }}</li>
                                                    <li><b>M: </b> {{ company.company_mobile }}</li>
                                                </Ul>
                                            </td>
                                            <td>{{ company.company_type }}</td>
                                            <td>{{ company.company_category }}</td>
                                            <td v-if="company.company_city == 0"> </td>
                                            <td else>{{ company.company_city }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                        <!-- <ul class="link-list-plain"> -->
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="#" @click="view_data(company.company_id)"><em class="icon ni ni-eye"></em><span>View</span></a></li>
                                                            <li><a href="#" v-if="company.is_verified == 0" @click="isVerified(company.company_id)"><em class="icon ni ni-check-thick"></em><span>Verify</span></a></li>
                                                            <li><a href="#" @click="edit_data(company.company_id)"><em class="icon ni ni-edit-alt"></em><span>update</span></a></li>
                                                            <li><a href="#" @click="delete_data(company.company_id)"><em class="icon ni ni-trash"></em><span>Remove</span></a></li>
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
        name: 'company',
        data() {
            return {
                companies: [],
                create_company: 'companies/create-company',
                categoryName: '',
            }
        },
        created() {
            axios.get('./companies/list')
            .then(response => {
                this.companies = response.data;
            });
        },
        methods: {
            getCompanyCategory(id) {
                axios.get('./companies/category-name/'+id)
                .then(response => {
                    this.categoryName = response.data;                    
                });
                return this.categoryName;
            },
            getEssentialCompany() {
                axios.get('./companies/list-essential')
                .then(response => {
                    this.companies = response.data;
                });
            },
            isFavorite: function(id) {
                axios.post('./companies/favorite/'+id)
                .then(response => {                    
                    location.reload();
                });
            },
            isUnFavorite: function(id) {
                axios.post('./companies/unFavorite/'+id)
                .then(response => {                    
                    location.reload();
                });
            },
            isVerified: function(id) {
                axios.post('./companies/verify/'+id)
                .then(response => {                    
                    location.reload();  
                });
            },
            view_data(id){
                window.location.href = './companies/view-company/'+id;
            },
            edit_data(id){
                window.location.href = './companies/edit-company/'+id;
            },
            delete_data(id){
                axios.delete('./companies/delete/'+id)
                .then(response => {                    
                    location.reload();
                });
            }
        },
        mounted() {
        },
    };
</script>
<style>
.icon.ni.ni-star, .icon.ni.ni-star-fill,
.icon.ni.ni-alert-fill, .icon.ni.ni-check-thick {
    font-size: 20px;

}
.icon.ni.ni-star, .icon.ni.ni-star-fill {
    cursor: pointer;
}
</style>