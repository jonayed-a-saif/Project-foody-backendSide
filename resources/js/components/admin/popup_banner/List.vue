<template>
	<div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h6 class="m-0 text-dark mt-3">Dashboard <i :style="someStyle" class="fas fa-chevron-right"></i> General Settings <i :style="someStyle" class="fas fa-chevron-right"></i> Popup Banner </h6>
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Popup Banner</h3>
                                <div class="card-tools">
                                    <button class="btn btn-primary" v-if="getAllPopupBanners.length == 0">
                                        <router-link to="/add-popup" class="text-white">Add New Popup Banner</router-link>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Popup Banner</th>
                                            <th>Title</th>
                                            <th>Text</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="getAllPopupBanners.length != 0">
                                        <tr v-for="(banner,index) in getAllPopupBanners" :key="banner.id">
                                            <td>{{index+1}}</td>
                                            <td><img :src="ourImage(banner.image)" class="img-fluid" height="60" width="100"></td>
                                            <td>{{banner.title}}</td>
                                            <td>{{banner.text}}</td>
                                            <td v-if="banner.status == 1"><a href="#" @click.prevent = "popupStatus(banner.id)" class="btn btn-sm btn-success rounded">Active</a></td>
                                            <td v-else><a href="#" @click.prevent = "popupStatus(banner.id)" class="btn btn-danger btn-sm rounded">Deactive</a></td>
                                            <td>{{banner.created_at | timeformat}}</td>
                                            <td>
                                                <router-link :to="`/edit-popup/${banner.id}`" class="btn btn-warning btn-sm rounded mb-1"><i class="fas fa-edit"></i></router-link>
                                                <a href="#" @click.prevent = "deleteBanner(banner.id)" class="btn btn-danger btn-sm rounded mb-1"><i class="fas fa-trash-alt"></i></a>
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
            this.$store.dispatch('allPopupBanners')
        },
        computed:{
            getAllPopupBanners(){
                return this.$store.getters.getPopupBannerForBackend
            }
        },
        methods:{
            ourImage(img){
                return "popup_banners/"+img;
            },
            deleteBanner(id){
                axios.get('/delete/popup/banner/'+id)
                    .then(()=>{
                        this.$store.dispatch('allPopupBanners')
                        toast.fire({
                            icon: 'success',
                            title: 'Popup Banner Deleted successfully'
                        })
                    })
                    .catch(()=>{
                        toast.fire({
                            icon: 'error',
                            text: 'Something went wrong',
                        })
                    })
            },
            popupStatus(id){
                axios.get('/popup/banner/status/change/'+id)
                    .then(()=>{
                        this.$store.dispatch('allPopupBanners')
                        toast.fire({
                            icon: 'success',
                            title: 'Popup Banner Status Changed successfully'
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
