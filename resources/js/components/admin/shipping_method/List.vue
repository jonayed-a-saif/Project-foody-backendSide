<template>
	<div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h6 class="m-0 text-dark mt-3">Dashboard <i :style="someStyle" class="fas fa-chevron-right"></i> General Settings <i :style="someStyle" class="fas fa-chevron-right"></i> Shipping Methods </h6>
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Shipping Methods</h3>
                                <div class="card-tools">
                                    <button class="btn btn-primary">
                                        <router-link to="/add-shippingMethod" class="text-white">Add New Shipping Method</router-link>
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
                                            <th>Duration</th>
                                            <th>Price</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="getAllShippingMethods.length != 0">
                                        <tr v-for="(shippingMethod,index) in getAllShippingMethods" :key="shippingMethod.id">
                                            <td>{{index+1}}</td>
                                            <td>{{shippingMethod.title}}</td>
                                            <td>{{shippingMethod.duration}}</td>
                                            <td>Tk. {{shippingMethod.price}}</td>
                                            <td>{{shippingMethod.created_at | timeformat}}</td>
                                            <td>
                                                <router-link :to="`/edit-shippingMethod/${shippingMethod.id}`" class="btn btn-warning btn-sm rounded mb-1"><i class="fas fa-edit"></i></router-link>
                                                <a href="#" @click.prevent = "deleteShippingMethod(shippingMethod.id)" class="btn btn-danger btn-sm rounded mb-1"><i class="fas fa-trash-alt"></i></a>
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
            this.$store.dispatch('allShippingMethods')
        },
        computed:{
            getAllShippingMethods(){
                return this.$store.getters.getShippingMethodsForBackend
            }
        },
        methods:{
            deleteShippingMethod(id){
                axios.get('/delete/shipping/method/'+id)
                    .then(()=>{
                        this.$store.dispatch('allShippingMethods')
                        toast.fire({
                            icon: 'success',
                            title: 'Shipping Method Deleted successfully'
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
