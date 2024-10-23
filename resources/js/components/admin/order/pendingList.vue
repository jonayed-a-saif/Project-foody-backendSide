<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card mt-3">
                            <div class="card-header bg-warning">
                                <h3 class="card-title">Pending Orders</h3>
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
                                    <tbody v-if="getAllPendingOrders.length != 0">
                                        <tr v-for="(order,index) in getAllPendingOrders" :key="order.id">
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
                                                <a href="#" @click.prevent = "processOrder(order.id)" class="btn btn-success btn-sm rounded mb-1"><i class="fas fa-check"></i></a>
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
    name: 'PendingList',
    data() {
        return {
            current_page: '',
            last_page: '',
            pageNumber:1,
            url:"/get/pending/orders/for/backend?page="+this.pageNumber
        };
    },
    mounted(){
        this.$store.dispatch('allPendingOrders',this.url),
            axios.get(this.url)
            .then((response) => {
                this.current_page=response.data.pendingOrders.current_page
                this.last_page=response.data.pendingOrders.last_page
            })
    },
    computed:{
        getAllPendingOrders(){
            return this.$store.getters.getPendingOrders
        }
    },
    methods:{
        processOrder(id){
            axios.get('/processing/order/'+id)
                .then(()=>{
                    this.$store.dispatch("allPendingOrders",this.url)
                    toast.fire({
                        icon: 'success',
                        title: 'Order send to Process'
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
                    this.$store.dispatch("allPendingOrders",this.url)
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
                    this.$store.dispatch("allPendingOrders",this.url)
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
        },
        nextPage(){
            if(this.pageNumber < this.last_page){
                this.pageNumber = this.pageNumber+1
            }
            this.url = "/get/pending/orders/for/backend?page="+this.pageNumber,
            this.$store.dispatch("allPendingOrders",this.url)
        },
        prevPage(){
            if(this.pageNumber > 1){
                this.pageNumber = this.pageNumber-1
            }
            this.url = "/get/pending/orders/for/backend?page="+this.pageNumber,
            this.$store.dispatch("allPendingOrders",this.url)
        },
    }
}
</script>

<style scoped>

</style>
