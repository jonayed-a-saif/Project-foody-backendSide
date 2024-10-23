<template>
	<div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h6 class="m-0 text-dark mt-3">Dashboard <i :style="someStyle" class="fas fa-chevron-right"></i> General Settings <i :style="someStyle" class="fas fa-chevron-right"></i> Footer </h6>
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Footer</h3>
                                <div class="card-tools">
                                    <button class="btn btn-primary">
                                        <router-link to="/add-footer" class="text-white">Add New Footer</router-link>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Footer Text</th>
                                            <th>Copyright Text</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="getFooter.length != 0">
                                        <tr v-for="(footer,index) in getFooter" :key="footer.id">
                                            <td>{{index+1}}</td>
                                            <td v-html="footer.footer_text"></td>
                                            <td v-html="footer.copyright_text"></td>
                                            <td>{{footer.created_at | timeformat}}</td>
                                            <td>
                                                <router-link :to="`/edit-footer/${footer.id}`" class="btn btn-warning btn-sm rounded mb-1"><i class="fas fa-edit"></i></router-link>
                                                <a href="#" @click.prevent = "deleteFooter(footer.id)" class="btn btn-danger btn-sm rounded mb-1"><i class="fas fa-trash-alt"></i></a>
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
            this.$store.dispatch('allFooter')
        },
        computed:{
            getFooter(){
                return this.$store.getters.getFooterForBackend
            }
        },
        methods:{
            deleteFooter(id){
                axios.get('/delete/footer/'+id)
                    .then(()=>{
                        this.$store.dispatch('allFooter')
                        toast.fire({
                            icon: 'success',
                            title: 'Footer Deleted successfully'
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
