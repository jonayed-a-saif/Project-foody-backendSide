<template>
	<div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h6 class="m-0 text-dark mt-3">Dashboard <i :style="someStyle" class="fas fa-chevron-right"></i> General Settings <i :style="someStyle" class="fas fa-chevron-right"></i> Pickup Location </h6>
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Pickup Location</h3>
                                <div class="card-tools">
                                    <button class="btn btn-primary">
                                        <router-link to="/add-pickup" class="text-white">Add New Location</router-link>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Loction</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="getAllPickupLocation.length != 0">
                                        <tr v-for="(pickup,index) in getAllPickupLocation" :key="pickup.id">
                                            <td>{{index+1}}</td>
                                            <td>{{pickup.title}}</td>
                                            <td>{{pickup.created_at | timeformat}}</td>
                                            <td>
                                                <router-link :to="`/edit-pickup/${pickup.id}`" class="btn btn-warning btn-sm rounded mb-1"><i class="fas fa-edit"></i></router-link>
                                                <a href="#" @click.prevent = "deletePickup(pickup.id)" class="btn btn-danger btn-sm rounded mb-1"><i class="fas fa-trash-alt"></i></a>
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
                            <div class="card-footer">
                                <div class="pagination">
                                    <button class="btn btn-sm btn-primary" @click.prevent="prevPage()">
                                        Previous
                                    </button>
                                    <span class="ml-2 mr-2">Page {{this.pageNumber}} of {{this.last_page}}</span>
                                    <button class="btn btn-sm btn-primary" @click.prevent="nextPage()">
                                        Next
                                    </button>
                                </div>
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
            current_page: '',
            last_page: '',
            pageNumber:1,
            url:"/get/pickup/location/for/backend?page="+this.pageNumber,
            someStyle: {
                    fontSize: '10px',
                },
            };
        },
        mounted(){
            this.$store.dispatch('allPickupLocation',this.url),
            axios.get(this.url)
            .then((response) => {
                this.current_page=response.data.pickup_location.current_page
                this.last_page=response.data.pickup_location.last_page
            })
        },
        computed:{
            getAllPickupLocation(){
                return this.$store.getters.getPickupLocationForBackend
            }
        },
        methods:{
            deletePickup(id){
                axios.get('/delete/pickup/'+id)
                    .then(()=>{
                        this.$store.dispatch("allPickupLocation",this.url)
                        toast.fire({
                            icon: 'success',
                            title: 'Pickup Location Deleted successfully'
                        })
                    })
                    .catch(()=>{
                        toast.fire({
                            icon: 'error',
                            text: 'Something went wrong',
                        })
                    })
            },
            nextPage(){
                if(this.pageNumber < this.last_page){
                    this.pageNumber = this.pageNumber+1
                }
                this.url = "/get/pickup/location/for/backend?page="+this.pageNumber,
                this.$store.dispatch("allPickupLocation",this.url)
            },
            prevPage(){
                if(this.pageNumber > 1){
                    this.pageNumber = this.pageNumber-1
                }
                this.url = "/get/pickup/location/for/backend?page="+this.pageNumber,
                this.$store.dispatch("allPickupLocation",this.url)
            },
        }
    }
</script>

<style lang="sass" scoped>

</style>
