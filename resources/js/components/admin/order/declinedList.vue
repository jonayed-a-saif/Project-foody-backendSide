<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card mt-3">
                            <div class="card-header bg-danger">
                                <h3 class="card-title">Declined Orders</h3>
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
                                            <th>Total</th>
                                            <th>Discount</th>
                                            <th>Payment</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="getAllDeclinedOrders.length != 0">
                                        <tr v-for="(order,index) in getAllDeclinedOrders" :key="order.id">
                                            <td>{{index+1}}</td>
                                            <td>{{order.shippingDateTime | timeformat}}</td>
                                            <td>{{order.slug}}</td>
                                            <td>{{order.user_name}}</td>
                                            <td>{{order.shipping}}</td>
                                            <td>{{order.total}} Taka</td>
                                            <td>{{order.discount}}</td>
                                            <td>{{order.payment_type}}</td>
                                            <td>
                                                <router-link :to="`/view-order/${order.id}`" class="btn btn-success btn-sm rounded mb-1">Details</router-link>
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
    name: 'DeclinedList',
    mounted(){
        this.$store.dispatch('allDeclinedOrders')
    },
    computed:{
        getAllDeclinedOrders(){
            return this.$store.getters.getDeclinedOrders
        }
    }
}
</script>

<style scoped>

</style>
