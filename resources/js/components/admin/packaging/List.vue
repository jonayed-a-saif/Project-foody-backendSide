<template>
	<div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h6 class="m-0 text-dark mt-3">Dashboard <i :style="someStyle" class="fas fa-chevron-right"></i> General Settings <i :style="someStyle" class="fas fa-chevron-right"></i> Packaging </h6>
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Packaging</h3>
                                <div class="card-tools">
                                    <button class="btn btn-primary">
                                        <router-link to="/add-packaging" class="text-white">Add New Packaging</router-link>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Title</th>
                                            <th>Subtitle</th>
                                            <th>Price</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="getAllPackaging.length != 0">
                                        <tr v-for="(packaging,index) in getAllPackaging" :key="packaging.id">
                                            <td>{{index+1}}</td>
                                            <td>{{packaging.title}}</td>
                                            <td>{{packaging.subtitle}}</td>
                                            <td>Tk. {{packaging.price}}</td>
                                            <td>{{packaging.created_at | timeformat}}</td>
                                            <td>
                                                <router-link :to="`/edit-packaging/${packaging.id}`" class="btn btn-warning btn-sm rounded mb-1"><i class="fas fa-edit"></i></router-link>
                                                <a href="#" @click.prevent = "deletePackaging(packaging.id)" class="btn btn-danger btn-sm rounded mb-1"><i class="fas fa-trash-alt"></i></a>
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
        data() {
            return {
            someStyle: {
                    fontSize: '10px',
                },
            };
        },
        mounted(){
            this.$store.dispatch('allPackaging')
        },
        computed:{
            getAllPackaging(){
                return this.$store.getters.getPackagingForBackend
            }
        },
        methods:{
            deletePackaging(id){
                axios.get('/delete/packaging/'+id)
                    .then(()=>{
                        this.$store.dispatch('allPackaging')
                        toast.fire({
                            icon: 'success',
                            title: 'Packaging Deleted successfully'
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
