<template>
	<div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h6 class="m-0 text-dark mt-3">Dashboard <i :style="someStyle" class="fas fa-chevron-right"></i> General Settings <i :style="someStyle" class="fas fa-chevron-right"></i> Website Loader </h6>
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Website Loader</h3>
                                <div class="card-tools">
                                    <button class="btn btn-primary" v-if="getAllLoaders.length == 0">
                                        <router-link to="/add-loader" class="text-white">Add New Loader</router-link>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Loader</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="getAllLoaders.length != 0">
                                        <tr v-for="(loader,index) in getAllLoaders" :key="loader.id">
                                            <td>{{index+1}}</td>
                                            <td><img :src="ourImage(loader.image)" class="img-fluid" height="60" width="60"></td>
                                            <td v-if="loader.status == 1"><a href="#" @click.prevent = "loaderStatus(loader.id)" class="btn btn-sm btn-success rounded">Active</a></td>
                                            <td v-else><a href="#" @click.prevent = "loaderStatus(loader.id)" class="btn btn-danger btn-sm rounded">Deactive</a></td>
                                            <td>{{loader.created_at | timeformat}}</td>
                                            <td>
                                                <router-link :to="`/edit-loader/${loader.id}`" class="btn btn-warning btn-sm rounded mb-1"><i class="fas fa-edit"></i></router-link>
                                                <a href="#" @click.prevent = "deleteLoader(loader.id)" class="btn btn-danger btn-sm rounded mb-1"><i class="fas fa-trash-alt"></i></a>
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
            this.$store.dispatch('allLoaders')
        },
        computed:{
            getAllLoaders(){
                return this.$store.getters.getLoaderForBackend
            }
        },
        methods:{
            ourImage(img){
                return "loader_images/"+img;
            },
            deleteLoader(id){
                axios.get('/delete/loader/'+id)
                    .then(()=>{
                        this.$store.dispatch('allLoaders')
                        toast.fire({
                            icon: 'success',
                            title: 'Loader Deleted successfully'
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
                axios.get('/loader/status/change/'+id)
                    .then(()=>{
                        this.$store.dispatch('allLoaders')
                        toast.fire({
                            icon: 'success',
                            title: 'Loader Status Changed successfully'
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
