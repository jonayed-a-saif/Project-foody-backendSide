<template>
	<div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Posters</h3>
                                <div class="card-tools">
                                    <button class="btn btn-primary">
                                        <router-link to="/add-poster" class="text-white">Add New Poster</router-link>
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
                                            <th>Position</th>
                                            <th>link</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="getAllPosters.length != 0">
                                        <tr v-for="(poster,index) in getAllPosters" :key="poster.id">
                                            <td>{{index+1}}</td>
                                            <td><img :src="ourImage(poster.image)" class="img-fluid" height="60" width="60"></td>
                                            <td>{{poster.position}}</td>
                                            <td>{{poster.link}}</td>
                                            <td>{{poster.created_at | timeformat}}</td>
                                            <td>
                                                <router-link :to="`/edit-poster/${poster.id}`" class="btn btn-warning btn-sm rounded mb-1"><i class="fas fa-edit"></i></router-link>
                                                <a href="#" @click.prevent = "deletePoster(poster.id)" class="btn btn-danger btn-sm rounded mb-1"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="6" class="text-center"><i class="far fa-folder-open"></i> No Data has been Found</td>
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
            this.$store.dispatch('allPosters')
        },
        computed:{
            getAllPosters(){
                return this.$store.getters.getPoster
            }
        },
        methods:{
            ourImage(img){
                return "poster_images/"+img;
            },
            deletePoster(id){
                axios.get('/delete/poster/'+id)
                    .then(()=>{
                       this.$store.dispatch("allPosters",this.url)
                        toast.fire({
                            icon: 'success',
                            title: 'Poster Deleted successfully'
                        })
                    })
                    .catch(()=>{
                        toast.fire({
                            icon: 'error',
                            text: 'Something Went Wrong',
                        })
                    })
            }
        }
    }
</script>

<style lang="sass" scoped>

</style>
