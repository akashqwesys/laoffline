<template>
    
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 v-if="scope == 'edit'" class="nk-block-title page-title">Edit State</h3>
                                <h3 v-else class="nk-block-title page-title">Add State</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Please fill the all details.</p>
                                </div>
                            </div><!-- .nk-block-head-content -->                            
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <form action="#" @submit.prevent="register()">
                                    <input type="hidden" v-if="scope == 'edit'" id="fv-group-id" v-model="form.id">
                                    <div class="preview-block">
                                        <div class="row gy-4">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-country">Country</label>
                                                    <div>
                                                        <select v-model="form.country_id" class="form-control" id="fv-country" data-placeholder="Select a option" required>
                                                            <option v-for="country in countries" :key="country.id" :value="country.id">{{country.name}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-city-name">Name</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="fv-city-name" v-model="form.name" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="preview-hr">
                                        <div class="row gy-4">                                        
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <a v-bind:href="cancel_url" class="btn btn-dim btn-secondary">Cancel</a>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    var states = [];
    export default {
        name: 'createStates',
        props: {
            scope: String,
            id: Number,
        },
        data() {
            return {
                cancel_url: '/settings/states',
                countries: [],
                states: [],
                form: new Form({
                    id: '',
                    country_id: '',
                    name: '',
                })
            }
        },
        created() {
            axios.get('./list-country')
            .then(response => {
                this.countries = response.data;
            });
        },
        methods: {
            register () {
                if (this.scope == 'edit') {
                    this.form.post('/settings/states/update')
                        .then(( response ) => {
                            window.location.href = '/settings/states';
                    })
                } else {
                    this.form.post('/settings/states/create')
                        .then(( response ) => {
                            window.location.href = '/settings/states';
                    })
                }
            },
        },
        mounted() {
            switch (this.scope) {
                case 'edit' :
                    axios.get(`/settings/states/fetch-states/${this.id}`)
                    .then(response => {
                        states = response.data;

                        this.form.id = states.id;
                        this.form.country_id = states.country_id;
                        this.form.name = states.name;
                    });
                    break;
                default:
                    break;
            }
        },
    };
</script>