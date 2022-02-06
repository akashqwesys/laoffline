<template>
    <div class="nk-content ">
        <vue-loader v-if="showLoader"></vue-loader>
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Product Lists</h3>
                                <div class="nk-block-des text-soft">
                                    <p>You have total {{products.length}} product.</p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">                                            
                                            <li class="nk-block-tools-opt">
                                                <a v-bind:href="create_product_category" class="dropdown-toggle btn btn-icon btn-primary"><em class="icon ni ni-plus"></em></a>
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
                                <table id="product" :class="excelAccess == 1 ? 'datatable-init-export table' : 'datatable-init table'" :data-export-title="excelAccess == 1 ? 'Export' : ''">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th></th>
                                            <th></th>
                                            <th>Name</th>
                                            <th>Catalogue Name</th>
                                            <th>Brand Name</th>
                                            <th>Model Name</th>
                                            <th>Company</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(product, index) in products" :key="index">
                                            <td>{{ index + 1 }}</td>
                                            <td>
                                                <em v-if="product.complaaete_flag == 0" class="icon ni ni-check-thick"></em>
                                                <em v-else class="icon ni ni-alert-fill"></em>
                                            </td>
                                            <td>
                                                <div class="user-card">
                                                    <div class="user-avatar user-avatar-sm product">
                                                        <img class="product_image" v-if="product.main_image != ''" :src="product.main_image" alt="">
                                                        <span v-if="product.main_image == ''">{{ product.product_name.charAt(0) }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ product.product_name }}</td>
                                            <td>{{ product.catalogue_name }}</td>
                                            <td>{{ product.brand_name }}</td>
                                            <td>{{ product.model }}</td>
                                            <td>{{ product.company_name }}</td>
                                            <td>{{ product.category_name }}</td>
                                            <td>{{ product.catalogue_price }}</td>
                                            <td>
                                                <a href="#" @click="view_data(product.product_id)" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="View"><em class="icon ni ni-eye"></em></a>
                                                <a href="#" @click="edit_data(product.product_id)" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Update"><em class="icon ni ni-edit-alt"></em></a>
                                                <a href="#" @click="delete_data(product.product_id)" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Remove"><em class="icon ni ni-trash"></em></a>                                                
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
        name: 'product',
        props: {
            excelAccess: Number,
        },
        components: { 
            VueLoader,
        },
        data() {
            return {
                products: [],
                showLoader:false,
                findImage: '',
                create_product_category: 'catalog/create-products',
            }
        },
        created() {
            this.showLoader = true;
            axios.get('./catalog/list')
            .then(response => {
                this.products = response.data;
                this.showLoader = false;
            });
        },
        methods: {
            edit_data(id){
                window.location.href = './catalog/edit-products/'+id;
            },
            view_data(id){
                // window.location.href = './catalog/edit-products/'+id;
            },
            delete_data(id){
                axios.delete('./catalog/delete/'+id)
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
    .user-avatar.user-avatar-sm.product {
        border-radius: 0;
        height: 50px;
        width: 50px;
    }
    .user-avatar.user-avatar-sm.product span {
        text-transform: capitalize;
        font-size: 20px;
    }
    .user-avatar img, [class^="user-avatar"]:not([class*="-group"]) img.product_image {
        border-radius: 0;
        height: 100%;
    }
</style>