<template>
    <div class="nk-content ">
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
                                <table class="datatable-init-export nowrap table" data-export-title="Export">
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
                                                        <img class="product_image" v-if="product.main_image != ''" v-bind:src="getProfilePic(product.product_name, product.main_image)" alt="">
                                                        <span v-if="product.main_image == ''">{{ product.product_name.charAt(0) }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td> {{ product.product_name }} </td>
                                            <td>{{ product.catalogue_name }}</td>
                                            <td>{{ product.brand_name }}</td>
                                            <td>{{ product.model }}</td>
                                            <td>{{ product.company_name }}</td>
                                            <td>{{ product.category_name }}</td>
                                            <td>{{ product.catalogue_price }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="#" @click="view_data(product.id)"><em class="icon ni ni-eye"></em><span>View</span></a></li>
                                                            <li><a href="#" @click="edit_data(product.id)"><em class="icon ni ni-edit-alt"></em><span>update</span></a></li>
                                                            <li><a href="#" @click="delete_data(product.id)"><em class="icon ni ni-trash"></em><span>Remove</span></a></li>
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
        name: 'product',
        data() {
            return {
                products: [],
                create_product_category: 'catalog/create-products',
            }
        },
        created() {
            axios.get('./catalog/list')
            .then(response => {
                this.products = response.data;
            });
        },
        methods: {
            edit_data(id){
                window.location.href = './catalog/edit-products/'+id;
            },
            delete_data(id){
                axios.delete('./catalog/delete/'+id)
                .then(response => {                    
                    location.reload();
                });
            },
            getProfilePic(pname, name){
                var d = name.split('_')[0];
                var path = d + '_' + pname.replace(/ /g,"_") + '/' + name;
                console.log(path);
                return '/upload/products/' + path;
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