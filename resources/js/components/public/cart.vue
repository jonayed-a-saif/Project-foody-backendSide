<template>

    <div>
        <topPart></topPart>

        <!--breadcrumbs area start-->
        <div class="breadcrumbs_area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb_content">
                            <ul>
                                <li><router-link to="/">home</router-link></li>
                                <li>Shopping Cart</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--breadcrumbs area end-->

        <!--shopping cart area start -->
        <div class="cart_page_bg">
            <div class="container">
                <div class="shopping_cart_area">
                    <form action="#">
                        <div class="row">
                            <div class="col-12">
                                <div class="table_desc">
                                    <div class="cart_page table-responsive">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th class="product_remove">Delete/Update</th>
                                                    <th class="product_thumb">Image</th>
                                                    <th class="product_name">Product</th>
                                                    <th class="product-price">Price</th>
                                                    <th class="product_quantity">Quantity</th>
                                                    <th class="product_total">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="cart in viewTotalCartInfo" :key="cart.id">
                                                    <td class="product_remove">
                                                        <a href="#" @click.prevent="deleteCartItem(cart.id)"><i class="fa fa-trash-o"></i></a>
                                                    </td>
                                                    <td class="product_thumb"><router-link :to="`/product-details/${cart.product_slug}`"><img :src="`/product_images/${cart.product_image}`" alt=""></router-link></td>
                                                    <td class="product_name"><router-link :to="`/product-details/${cart.product_slug}`">{{cart.product_name}}</router-link></td>
                                                    <td class="product-price">৳ {{cart.price}}</td>
                                                    <td class="product_quantity"><label v-if="cart.qty == 1">{{cart.qty}} piece</label><label v-else>{{cart.qty}} pieces</label></td>
                                                    <td class="product_total">৳ {{cart.price*cart.qty}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- <div class="cart_submit">
                                        <button type="submit">update cart</button>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <!--coupon code area start-->
                        <div class="coupon_area">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="coupon_code left">
                                        <h3>Coupon</h3>
                                        <div class="coupon_inner">
                                            <p>Enter your coupon code if you have one.</p>
                                            <form role="form" @submit.prevent="checkCoupon()">
                                                <input placeholder="Coupon code" type="text" v-model="form.coupon">
                                                <button type="submit">Apply coupon</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="coupon_code right">
                                        <h3>Cart Totals</h3>
                                        <div class="coupon_inner">
                                            <div class="cart_subtotal">
                                                <p>Subtotal</p>
                                                <p class="cart_amount">৳ {{viewTotalCartAmount}}</p>
                                            </div>
                                            <div class="cart_subtotal ">
                                                <p>Shipping</p>
                                                <p class="cart_amount"><span>Flat Rate:</span>৳ {{viewTotalCartAmount}}</p>
                                            </div>
                                            <a href="#">Calculate shipping</a>

                                            <div class="cart_subtotal">
                                                <p>Discount</p>
                                                <p class="cart_amount">12%</p>
                                            </div>

                                            <div class="cart_subtotal">
                                                <p>Total</p>
                                                <p class="cart_amount">৳ {{viewTotalCartAmount}}</p>
                                            </div>
                                            <div class="checkout_btn">
                                                <router-link to="/checkout">Proceed to Checkout</router-link>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--coupon code area end-->
                    </form>
                </div>
            </div>
        </div>
        <!--shopping cart area end -->
    </div>

</template>

<script>
import topPart from "./Header.vue"
export default {
    name: 'cart',
    components:{
        topPart
    },
    data(){
        return{
            form: new Form({
                coupon: ''
            })
        }
    },
    mounted() {
        this.$store.dispatch('totalCartAmount')
        this.$store.dispatch('totalCartInfo')
    },
    computed:{
        viewTotalCartAmount(){
            return this.$store.getters.getTotalCartAmount
        },
        viewTotalCartInfo(){
            return this.$store.getters.getTotalCartInfo
        }
    },
    methods:{
        deleteCartItem(id){
            axios.get('/delete/cart/item/'+id)
                .then(()=>{
                    this.$store.dispatch('totalCartAmount')
                    this.$store.dispatch('totalCartQty')
                    this.$store.dispatch('totalCartInfo')
                    toast.fire({
                        icon: 'success',
                        title: 'Cart Item Deleted'
                    })
                })
                .catch(()=>{
                    toast.fire({
                        icon: 'error',
                        text: 'Something went wrong',
                    })
                })
        },
        checkCoupon(){
            this.form.post('check/coupon')
            .then(({ response }) => {
                this.$router.push('/cart/');
                this.$store.dispatch('totalCartAmount')
                this.$store.dispatch('totalCartQty')
                this.$store.dispatch('totalCartInfo')

                toast.fire({
                    icon: 'success',
                    title: 'Coupon Applied'
                })

            })
            .catch(()=>{
                toast.fire({
                    icon: 'error',
                    text: 'Coupon Expired',
                })
            })
        }
    }
}
</script>

<style scoped>

</style>
