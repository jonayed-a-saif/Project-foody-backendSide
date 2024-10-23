<template>
	<div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">logo / Icon</h3>
                                <div class="card-tools">
                                    <button class="btn btn-primary" v-if="getAllLogos.length == 0">
                                        <router-link to="/add-logo" class="text-white">Add New Logo</router-link>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Logo</th>
                                            <th>Icon</th>
                                            <th>Website Title</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="getAllLogos.length != 0">
                                        <tr v-for="(logo,index) in getAllLogos" :key="logo.id">
                                            <td>{{index+1}}</td>
                                            <td><img :src="ourImage(logo.icon)" class="img-fluid" height="30" width="30"></td>
                                            <td><img :src="ourImage(logo.logo)" class="img-fluid" height="60" width="60"></td>
                                            <td>{{logo.title}}</td>
                                            <td>{{logo.created_at | timeformat}}</td>
                                            <td>
                                                <router-link :to="`/edit-logo/${logo.id}`" class="btn btn-warning btn-sm rounded mb-1"><i class="fas fa-edit"></i></router-link>
                                                <a href="#" @click.prevent = "deleteLogo(logo.id)" class="btn btn-danger btn-sm rounded mb-1"><i class="fas fa-trash-alt"></i></a>
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
            this.$store.dispatch('allLogos')
        },
        computed:{
            getAllLogos(){
                return this.$store.getters.getLogoForFrontend
            }
        },
        methods:{
            ourImage(img){
                return "logo_images/"+img;
            },
            deleteLogo(id){
                axios.get('/delete/logo/'+id)
                    .then(()=>{
                        this.$store.dispatch('allLogos')
                        toast.fire({
                            icon: 'success',
                            title: 'Logo Deleted successfully'
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
