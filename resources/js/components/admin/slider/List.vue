<template>
	<div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Sliders</h3>
                                <div class="card-tools">
                                    <button class="btn btn-primary">
                                        <router-link to="/add-slider" class="text-white">Add New Slider</router-link>
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
                                            <th>Title</th>
                                            <th>link</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="getAllSlider.length != 0">
                                        <tr v-for="(slider,index) in getAllSlider" :key="slider.id">
                                            <td>{{index+1}}</td>
                                            <td><img :src="ourImage(slider.image)" class="img-fluid" height="60" width="60"></td>
                                            <td>{{slider.title}}</td>
                                            <td>{{slider.link}}</td>
                                            <td>{{slider.created_at | timeformat}}</td>
                                            <td>
                                                <router-link :to="`/edit-slider/${slider.id}`" class="btn btn-warning btn-sm rounded mb-1"><i class="fas fa-edit"></i></router-link>
                                                <a href="#" @click.prevent = "deleteCategory(slider.id)" class="btn btn-danger btn-sm rounded mb-1"><i class="fas fa-trash-alt"></i></a>
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
            this.$store.dispatch('allSliders')
        },
        computed:{
            getAllSlider(){
                return this.$store.getters.getSlider
            }
        },
        methods:{
            ourImage(img){
                return "slider_images/"+img;
            },
            deleteCategory(id){
                axios.get('/delete/slider/'+id)
                    .then(()=>{
                       this.$store.dispatch('allSliders')
                        toast.fire({
                            icon: 'success',
                            title: 'Slider Deleted successfully'
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
