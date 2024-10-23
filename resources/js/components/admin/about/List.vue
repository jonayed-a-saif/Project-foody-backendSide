<template>
	<div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">About Us</h3>
                                <div class="card-tools">
                                    <button class="btn btn-primary" v-if="getAllAbouts.length == 0">
                                        <router-link to="/add-about" class="text-white">Add New Text</router-link>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Image</th>
                                            <th>Details</th>
                                            <th>Tag Line</th>
                                            <th>Location</th>
                                            <th>Contact</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="getAllAbouts.length != 0">
                                        <tr v-for="(about,index) in getAllAbouts" :key="about.id">
                                            <td>{{index+1}}</td>
                                            <td><img :src="ourImage(about.image)" class="img-fluid" height="60" width="60"></td>
                                            <td>{{about.details | shortLength(100,"...")}}</td>
                                            <td>{{about.tag_line}}</td>
                                            <td>{{about.location}}</td>
                                            <td>{{about.contact}}</td>
                                            <td>{{about.created_at | timeformat}}</td>
                                            <td>
                                                <router-link :to="`/edit-about/${about.id}`" class="btn btn-warning btn-sm rounded mb-1"><i class="fas fa-edit"></i></router-link>
                                                <a href="#" @click.prevent="deleteAbout(about.id)" class="btn btn-danger btn-sm rounded mb-1"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="8" class="text-center"><i class="far fa-folder-open"></i> No Data has been Found</td>
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
        mounted(){
            this.$store.dispatch('allAbouts')
        },
        computed:{
            getAllAbouts(){
                return this.$store.getters.getAllAboutForBackend
            }
        },
        methods:{
        ourImage(img){
            return "about_images/"+img;
        },
        deleteAbout(id){
            axios.get('/delete/about/'+id)
                .then(()=>{
                    this.$store.dispatch("allAbouts",this.url)
                    toast.fire({
                        icon: 'success',
                        title: 'About Deleted successfully'
                    })
                })
                .catch(()=>{
                    toast.fire({
                        icon: 'error',
                        text: ' Something went wrong',
                    })
                })
        }
    }
    }
</script>

<style lang="sass" scoped>

</style>
