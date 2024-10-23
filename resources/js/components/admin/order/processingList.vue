<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card mt-3">
                            <div class="card-header bg-info">
                                <h3 class="card-title">Processing Orders</h3>
                                <div class="card-tools">

                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Order Placed</th>
                                            <th>SaleID</th>
                                            <th>User Name</th>
                                            <th>Shipping</th>
                                            <th>Discount</th>
                                            <th>Total</th>
                                            <th>Payment</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="getAllProcessingOrders.length != 0">
                                        <tr v-for="(order,index) in getAllProcessingOrders" :key="order.id">
                                            <td>{{index+1}}</td>
                                            <td>{{order.created_at | timeformat}}</td>
                                            <td>{{order.slug}}</td>
                                            <td>{{order.user_name}}</td>
                                            <td>{{order.shipping}}</td>
                                            <td>{{order.discount}}</td>
                                            <td>{{order.total}} Taka</td>
                                            <td>{{order.payment_type}}</td>
                                            <td>
                                                <router-link :to="`/view-order/${order.id}`" class="btn btn-warning btn-sm rounded mb-1"><i class="fas fa-edit"></i></router-link>
                                                <a href="#" @click.prevent = "deleteOrder(order.id)" class="btn btn-danger btn-sm rounded mb-1"><i class="fas fa-trash-alt"></i></a>
                                                <a href="#" @click.prevent = "completeOrder(order.id)" class="btn btn-success btn-sm rounded mb-1"><i class="fas fa-check"></i></a>
                                                <a href="#" @click.prevent = "declineOrder(order.id)" class="btn btn-danger btn-sm rounded mb-1"><i class="fas fa-times"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="9" class="text-center"><i class="far fa-folder-open"></i> No Data has been Found</td>
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
    name: 'ProcessingList',
    mounted(){
        this.$store.dispatch('allProcessingOrders')
    },
    computed:{
        getAllProcessingOrders(){
            return this.$store.getters.getProcessingOrders
        }
    },
    methods:{
        completeOrder(id){
            axios.get('/complete/order/'+id)
                .then(()=>{
                    this.$store.dispatch('allProcessingOrders')
                    toast.fire({
                        icon: 'success',
                        title: 'Order successfully Delivered'
                    })
                })
                .catch(()=>{
                    toast.fire({
                        icon: 'error',
                        text: 'Something went wrong',
                    })
                })
        },
        declineOrder(id){
            axios.get('/order/decline/'+id)
                .then(()=>{
                    this.$store.dispatch('allProcessingOrders')
                    toast.fire({
                        icon: 'error',
                        title: 'Order Declined'
                    })
                })
                .catch(()=>{
                    toast.fire({
                        icon: 'error',
                        text: 'Something went wrong',
                    })
                })
        },
        deleteOrder(id){
            axios.get('/delete/order/'+id)
                .then(()=>{
                    this.$store.dispatch('allProcessingOrders')
                    toast.fire({
                        icon: 'error',
                        title: 'Order successfully Deleted'
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

<style scoped>

</style>
