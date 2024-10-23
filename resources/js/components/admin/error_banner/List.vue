<template>
	<div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h6 class="m-0 text-dark mt-3">Dashboard <i :style="someStyle" class="fas fa-chevron-right"></i> General Settings <i :style="someStyle" class="fas fa-chevron-right"></i> Error Banner </h6>
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Error Banner</h3>
                                <div class="card-tools">
                                    <button class="btn btn-primary" v-if="getAllErrorBanner.length == 0">
                                        <router-link to="/add-error" class="text-white">Add New Error Banner</router-link>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Error Banner</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="getAllErrorBanner.length != 0">
                                        <tr v-for="(error,index) in getAllErrorBanner" :key="error.id">
                                            <td>{{index+1}}</td>
                                            <td><img :src="ourImage(error.image)" class="img-fluid" height="60" width="60"></td>
                                            <td v-if="error.status == 1"><a href="#" @click.prevent = "loaderStatus(error.id)" class="btn btn-sm btn-success rounded">Active</a></td>
                                            <td v-else><a href="#" @click.prevent = "loaderStatus(error.id)" class="btn btn-danger btn-sm rounded">Deactive</a></td>
                                            <td>{{error.created_at | timeformat}}</td>
                                            <td>
                                                <router-link :to="`/edit-error/${error.id}`" class="btn btn-warning btn-sm rounded mb-1"><i class="fas fa-edit"></i></router-link>
                                                <a href="#" @click.prevent = "deleteErrorBanner(error.id)" class="btn btn-danger btn-sm rounded mb-1"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="5" class="text-center"><i class="far fa-folder-open"></i> No Data has been Found</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
	</div>
</template>

<script>
    export default {
        name:"List",
        data() {
            return {
            someStyle: {
                    fontSize: '10px',
                },
            };
        },
        mounted(){
            this.$store.dispatch('allErrorBanner')
        },
        computed:{
            getAllErrorBanner(){
                return this.$store.getters.getErrorBannerForBackend
            }
        },
        methods:{
            ourImage(img){
                return "error_banner/"+img;
            },
            deleteErrorBanner(id){
                axios.get('/delete/error/banner/'+id)
                    .then(()=>{
                        this.$store.dispatch('allErrorBanner')
                        toast.fire({
                            icon: 'success',
                            title: 'Error Banner Deleted successfully'
                        })
                    })
                    .catch(()=>{
                        toast.fire({
                            icon: 'error',
                            text: 'Something went wrong',
                        })
                    })
            },
            loaderStatus(id){
                axios.get('/error/banner/status/change/'+id)
                    .then(()=>{
                        this.$store.dispatch('allErrorBanner')
                        toast.fire({
                            icon: 'success',
                            title: 'Banner Status Changed successfully'
                        })
                    })
                    .catch(()=>{
                        toast.fire({
                            icon: 'error',
                            text: 'Something went wrong',
                        })
                    })
            }
        }
    }
</script>

<style lang="sass" scoped>

</style>
