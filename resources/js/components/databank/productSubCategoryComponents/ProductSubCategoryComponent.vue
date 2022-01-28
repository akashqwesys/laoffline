<template>
    <div class="nk-content ">
        <vue-loader v-if="showLoader"></vue-loader>
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Product Sub Category Lists</h3>
                                <div class="nk-block-des text-soft">
                                    <p>You have total {{productSubCategories.length}} product sub category.</p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">                                            
                                            <li class="nk-block-tools-opt">
                                                <a v-bind:href="create_product_sub_category" class="dropdown-toggle btn btn-icon btn-primary"><em class="icon ni ni-plus"></em></a>
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
                                            <th>Name</th>
                                            <th>Main Category</th>
                                            <th>Fabric Group</th>
                                            <th>Company</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(productSubCategory, index) in productSubCategories" :key="index">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ productSubCategory.name }}</td>
                                            <td>{{ productSubCategory.categoryName }}</td>
                                            <td>{{ productSubCategory.fabricGroupName }}</td>
                                            <td>{{ productSubCategory.companyName }}</td>
                                            <!-- <td v-if="productSubCategory.company_id != ''">{{ getCompanyName(productSubCategory.company_id) }}</td> -->
                                            <!-- <td else></td> -->
                                            <td>
                                                <div class="dropdown">
                                                    <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="#" @click="edit_data(productSubCategory.id)"><em class="icon ni ni-edit-alt"></em><span>update</span></a></li>
                                                            <li><a href="#" @click="delete_data(productSubCategory.id)"><em class="icon ni ni-trash"></em><span>Remove</span></a></li>
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
    import VueLoader from './../../../VueLoader';

    export default {
        name: 'productSubCategory',
        components: { 
            VueLoader,
        },
        data() {
            return {
                productSubCategories: [],
                showLoader:false,
                create_product_sub_category: 'productsub-category/create-productsub-category',
            }
        },
        created() {
            this.showLoader = true;
            axios.get('./productsub-category/list')
            .then(response => {
                this.productSubCategories = response.data;
                this.showLoader = false;
            });
        },
        methods: {
            getCompanyName(id){
                axios.get('./productsub-category/company-name/'+id)
                .then(response => {
                    var companyName = response.data;

                    return companyName;
                });
            },
            edit_data(id){
                window.location.href = './productsub-category/edit-productsub-category/'+id;
            },
            delete_data(id){
                axios.delete('./productsub-category/delete/'+id)
                .then(response => {                    
                    location.reload();
                });
            }
        },
        mounted() {
        },
    };
</script>