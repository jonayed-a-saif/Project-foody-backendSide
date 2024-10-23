<template>
	<div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h6 class="m-0 text-dark mt-3">Dashboard <i :style="someStyle" class="fas fa-chevron-right"></i> General Settings <i :style="someStyle" class="fas fa-chevron-right"></i> Website Color </h6>
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Website Color</h3>
                                <div class="card-tools">
                                    <button class="btn btn-primary" v-if="getWebsiteColors.length == 0">
                                        <router-link to="/add-websiteColor" class="text-white">Add New Colors</router-link>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Theme Color</th>
                                            <th>Menu Color</th>
                                            <th>Footer Color</th>
                                            <th>Copyright Color</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="getWebsiteColors.length != 0">
                                        <tr v-for="(color,index) in getWebsiteColors" :key="color.id">
                                            <td>{{index+1}}</td>
                                            <td class="text-center"><span :style="{ background: color.theme_color }">{{color.theme_color}}</span></td>
                                            <td class="text-center"><span :style="{ background: color.menu_color }">{{color.menu_color}}</span></td>
                                            <td class="text-center"><span :style="{ background: color.footer_color }">{{color.footer_color}}</span></td>
                                            <td class="text-center"><span :style="{ background: color.copyright_color }">{{color.copyright_color}}</span></td>
                                            <td>{{color.created_at | timeformat}}</td>
                                            <td>
                                                <router-link :to="`/edit-websiteColor/${color.id}`" class="btn btn-warning btn-sm rounded mb-1"><i class="fas fa-edit"></i></router-link>
                                                <a href="#" @click.prevent = "deleteWebsiteColor(color.id)" class="btn btn-danger btn-sm rounded mb-1"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="7" class="text-center"><i class="far fa-folder-open"></i> No Data has been Found</td>
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
            this.$store.dispatch('allWebsiteColors')
        },
        computed:{
            getWebsiteColors(){
                return this.$store.getters.getWebsiteColorForBackend
            }
        },
        methods:{
            deleteWebsiteColor(id){
                axios.get('/delete/website/color/'+id)
                    .then(()=>{
                        this.$store.dispatch('allWebsiteColors')
                        toast.fire({
                            icon: 'success',
                            title: 'Website Color Deleted successfully'
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
