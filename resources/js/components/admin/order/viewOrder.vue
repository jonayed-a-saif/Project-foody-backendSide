<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="row mt-3 mb-4">
                            <div class="col-lg-12 text-right">
                                <button class="btn btn-sm btn-success rounded" @click.prevent="printOrder()">Print Order</button>
                            </div>
                            <div class="col-lg-12 text-center">
                                <img :src="ourImage(this.shop_info.logo)" class="img-fluid" height="50" width="50">
                                <h3><b>{{this.shop_info.title}}</b></h3>
                                <b>Shop Address : {{this.about_info.location}}</b><br>
                                <b>Hotline Number : {{this.about_info.contact}}</b><br>
                            </div>
                        </div>


                        <table class="w-100 mt-5 mb-4">
                            <tr>
                                <td>
                                    <h5><b>Shipping Info :</b></h5>
                                    <b>Name : </b>{{this.shippingDetails.name}}<br>
                                    <b>Country : </b>{{this.shippingDetails.country}}<br>
                                    <b>City : </b>{{this.shippingDetails.city}}<br>
                                    <b>Address : </b>{{this.shippingDetails.address}}<br>
                                    <b>Phone : </b>{{this.shippingDetails.phone}}<br>
                                    <b>Email : </b>{{this.shippingDetails.email}}<br>
                                </td>
                                <td class="text-right">
                                    <h5><b>Invoice Info :</b></h5>
                                    <b>Invoice No. </b>{{this.sale.slug}}<br>
                                    <b>Order Placed : </b>{{this.shippingDetails.created_at | timeformat}}<br>
                                    <b>Special Note : </b>{{this.shippingDetails.order_notes}}<br>
                                    <b>Payment Type : </b>{{this.sale.payment_type}}<br>
                                    <b>Amount to be Paid : </b>{{this.sale.total}} Taka Only<br>
                                </td>
                            </tr>
                        </table>

                        <div class="card mt-3 mb-5">
                            <div class="card-header">
                                <h3 class="card-title"><b>Purchased items</b></h3>
                                <div class="card-tools">

                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                           
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(order) in this.orderDetails" :key="order.id">
                                           
                                            <td style="font-size:10px;">{{order.product_name}}</td>
                                            <td style="font-size:10px;">Tk. {{order.price}}</td>
                                            <td style="font-size:10px;">{{order.qty}}</td>
                                            <td style="font-size:10px;">Tk. {{order.price*order.qty}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer text-right">
                                <b>Discount</b> = <span v-if="this.sale.discount != null">{{this.sale.discount}}</span> <span v-else>0</span> Taka<br>
                                <b>Shipping & Packaging</b> = {{this.sale.shipping}}<br>
                                <b>SubTotal</b> = {{this.sale.total-this.sale.discount}} Taka Only <br>
                                <b>Grand Total</b> = {{this.sale.total}} Taka Only
                            </div>
                        </div>


                        <table class="w-100 mt-30" :style="someStyle">
                            <tr>
                                <td>
                                    _________________
                                    <h5><b>Authorized By</b></h5>
                                </td>
                                <td class="text-right">
                                    _______________________
                                    <h5><b>{{this.shippingDetails.name}}</b></h5>
                                </td>
                            </tr>
                        </table>


                    </div>
                </div>
            </div>
        </section>

    </div>
</template>

<script>
export default {
    name: 'Details',
    data(){
        return{
            sale: null,
            about_info: null,
            shop_info: null,
            orderDetails: [],
            shippingDetails: null,
            someStyle: {
                'padding-top': '50px',
            },
        }
    },
    created(){
        axios.get(`/view/order/details/${this.$route.params.orderId}`)
            .then((response)=>{
                this.orderDetails = response.data.orderDetails
                axios.get(`/view/shipping/details/${this.$route.params.orderId}`)
                    .then((response)=>{
                        this.shippingDetails = response.data.shippingDetails
                        axios.get(`/calculate/sales/details/${this.$route.params.orderId}`)
                            .then((response)=>{
                                this.sale = response.data.sale
                                axios.get('/shop/info/')
                                    .then((response)=>{
                                        this.shop_info = response.data.shop_info
                                        this.about_info = response.data.about_info
                                    })
                                    .catch(()=>{
                                        console.log("Error")
                                    })
                            })
                            .catch(()=>{
                                console.log("Error")
                            })
                    })
                    .catch(()=>{
                        console.log("Error")
                    })
            })
            .catch(()=>{
                console.log("Error")
            })
    },
    methods:{
          ourImage(img){
            return "/logo_images/"+img;
        },
        printOrder(){
            window.print()
        },
      
    }
}
</script>

<style scoped>

</style>
