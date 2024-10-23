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
                                <li><a href="index.html">home</a></li>
                                <li>Checkout</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--breadcrumbs area end-->

        <!--Checkout page section-->
        <div class="checkout_page_bg">
            <div class="container">
                <div class="Checkout_section">
                    <div class="row">
                        <div class="col-12">
                            <div class="user-actions">
                                <h3>
                                    <i class="fa fa-file-o" aria-hidden="true"></i>
                                    Returning customer?
                                    <a class="Returning" href="#" data-toggle="collapse" data-target="#checkout_login" aria-expanded="true">Click here to login</a>

                                </h3>
                                <div id="checkout_login" class="collapse" data-parent="#accordion">
                                    <div class="checkout_info">
                                        <p>If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing & Shipping section.</p>
                                        <form action="#">
                                            <div class="form_group">
                                                <label>Username or email <span>*</span></label>
                                                <input type="text">
                                            </div>
                                            <div class="form_group">
                                                <label>Password <span>*</span></label>
                                                <input type="text">
                                            </div>
                                            <div class="form_group group_3 ">
                                                <button type="submit">Login</button>
                                                <label for="remember_box">
                                                    <input id="remember_box" type="checkbox">
                                                    <span> Remember me </span>
                                                </label>
                                            </div>
                                            <a href="#">Lost your password?</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="user-actions">
                                <h3>
                                    <i class="fa fa-file-o" aria-hidden="true"></i>
                                    Returning customer?
                                    <a class="Returning" href="#" data-toggle="collapse" data-target="#checkout_coupon" aria-expanded="true">Click here to enter your code</a>
                                </h3>
                                <div id="checkout_coupon" class="collapse" data-parent="#accordion">
                                    <div class="checkout_info">
                                        <form action="#">
                                            <input placeholder="Coupon code" type="text">
                                            <button type="submit">Apply coupon</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="checkout_form">
                        <form role="form">

                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="checkout_form_left">

                                            <h3>Billing Details</h3>
                                            <div class="row">

                                                <div class="col-lg-12 mb-20">
                                                    <label>Full Name <span>*</span></label>
                                                    <input type="text" v-model="form.name" name="name" :class="{ 'is-invalid': form.errors.has('name') }" required>
                                                    <has-error :form="form" field="name"></has-error>
                                                </div>
                                                <div class="col-12 mb-20">
                                                    <label>Company Name</label>
                                                    <input type="text" v-model="form.company_name" name="company_name" :class="{ 'is-invalid': form.errors.has('company_name') }" required>
                                                    <has-error :form="form" field="company_name"></has-error>
                                                </div>
                                                <div class="col-12 mb-20">
                                                    <label for="country">country <span>*</span></label>
                                                    <select class="form-control" v-model="form.country" name="cuntry"  :class="{ 'is-invalid': form.errors.has('country') }">
                                                        <option disabled value="">Select One</option>
                                                        <option value="2">Bangladesh</option>
                                                        <option value="3">Algeria</option>
                                                        <option value="4">Afghanistan</option>
                                                        <option value="5">Ghana</option>
                                                        <option value="6">Albania</option>
                                                        <option value="7">Bahrain</option>
                                                        <option value="8">Colombia</option>
                                                        <option value="9">Dominican Republic</option>
                                                    </select>
                                                    <has-error :form="form" field="country"></has-error>
                                                </div>

                                                <div class="col-12 mb-20">
                                                    <label>Street address <span>*</span></label>
                                                    <input type="text" placeholder="House number and street name" v-model="form.address" name="address" :class="{ 'is-invalid': form.errors.has('address') }" required>
                                                    <has-error :form="form" field="address"></has-error>
                                                </div>
                                                <div class="col-12 mb-20">
                                                    <input type="text" placeholder="Apartment, suite, unit etc. (optional)" v-model="form.apartment" name="apartment" :class="{ 'is-invalid': form.errors.has('apartment') }">
                                                    <has-error :form="form" field="apartment"></has-error>
                                                </div>
                                                <div class="col-12 mb-20">
                                                    <label>Town / City <span>*</span></label>
                                                    <input type="text" v-model="form.city" name="city" :class="{ 'is-invalid': form.errors.has('city') }" required>
                                                    <has-error :form="form" field="city"></has-error>
                                                </div>
                                                <div class="col-lg-6 mb-20">
                                                    <label>Phone<span>*</span></label>
                                                     <input type="text" v-model="form.phone" name="phone" :class="{ 'is-invalid': form.errors.has('phone') }" required>
                                                    <has-error :form="form" field="phone"></has-error>
                                                </div>
                                                <div class="col-lg-6 mb-20">
                                                    <label> Email Address <span>*</span></label>
                                                    <input type="email" v-model="form.email" name="email" :class="{ 'is-invalid': form.errors.has('email') }" required>
                                                    <has-error :form="form" field="email"></has-error>

                                                </div>
                                                <div class="col-12 mb-20">
                                                    <input id="account" type="checkbox" data-target="createp_account" />
                                                    <label for="account" data-toggle="collapse" data-target="#collapseOne" aria-controls="collapseOne">Create an account?</label>

                                                    <div id="collapseOne" class="collapse one" data-parent="#accordion">
                                                        <div class="card-body1">
                                                            <label> Account password <span>*</span></label>
                                                             <input type="password" placeholder="password" v-model="form.password" name="password" :class="{ 'is-invalid': form.errors.has('password') }" required>
                                                            <has-error :form="form" field="password"></has-error>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-12 mb-20">
                                                    <input id="address" type="checkbox" data-target="createp_account" />
                                                    <label class="righ_0" for="address" data-toggle="collapse" data-target="#collapsetwo" aria-controls="collapseOne">Ship to a different address?</label>

                                                    <div id="collapsetwo" class="collapse one" data-parent="#accordion">
                                                        <div class="row">
                                                            <div class="col-lg-6 mb-20">
                                                                <label>First Name <span>*</span></label>
                                                                <input type="text">
                                                            </div>
                                                            <div class="col-lg-6 mb-20">
                                                                <label>Last Name <span>*</span></label>
                                                                <input type="text">
                                                            </div>
                                                            <div class="col-12 mb-20">
                                                                <label>Company Name</label>
                                                                <input type="text">
                                                            </div>
                                                            <div class="col-12 mb-20">
                                                                <div class="select_form_select">
                                                                    <label for="countru_name">country <span>*</span></label>
                                                                    <select class="niceselect_option" name="cuntry" id="countru_name">
                                                                        <option value="2">bangladesh</option>
                                                                        <option value="3">Algeria</option>
                                                                        <option value="4">Afghanistan</option>
                                                                        <option value="5">Ghana</option>
                                                                        <option value="6">Albania</option>
                                                                        <option value="7">Bahrain</option>
                                                                        <option value="8">Colombia</option>
                                                                        <option value="9">Dominican Republic</option>

                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 mb-20">
                                                                <label>Street address <span>*</span></label>
                                                                <input placeholder="House number and street name" type="text">
                                                            </div>
                                                            <div class="col-12 mb-20">
                                                                <input placeholder="Apartment, suite, unit etc. (optional)" type="text">
                                                            </div>
                                                            <div class="col-12 mb-20">
                                                                <label>Town / City <span>*</span></label>
                                                                <input type="text">
                                                            </div>
                                                            <div class="col-12 mb-20">
                                                                <label>State / County <span>*</span></label>
                                                                <input type="text">
                                                            </div>
                                                            <div class="col-lg-6 mb-20">
                                                                <label>Phone<span>*</span></label>
                                                                <input type="text">

                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label> Email Address <span>*</span></label>
                                                                <input type="text">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <div class="col-12">
                                                    <div class="order-notes">
                                                        <label for="order_note">Order Notes</label>
                                                        <textarea id="order_note" placeholder="Notes about your order, e.g. special notes for delivery." v-model="form.order_notes" name="order_notes" :class="{ 'is-invalid': form.errors.has('order_notes') }"></textarea>
                                                        <has-error :form="form" field="order_notes"></has-error>
                                                    </div>
                                                </div>
                                            </div>

                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="checkout_form_right">

                                            <h3>Your order</h3>
                                            <div class="order_table table-responsive">
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="cart in viewTotalCartInfo" :key="cart.id">
                                                            <td> {{cart.product_name}} <strong> × {{cart.qty}}</strong></td>
                                                            <td>৳ {{cart.price}}</td>
                                                        </tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Cart Subtotal</th>
                                                            <td>৳ {{viewTotalCartAmount}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Shipping</th>
                                                            <td><strong>৳ 60</strong></td>
                                                        </tr>
                                                        <tr class="order_total">
                                                            <th>Order Total</th>
                                                            <td><strong>৳ {{viewTotalCartAmount+60}}</strong></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <div class="payment_method">
                                                <div class="panel-default">
                                                    <input id="payment" name="check_method" type="radio" data-target="createp_account" />
                                                    <label for="payment" data-toggle="collapse" data-target="#method" aria-controls="method">Create an account?</label>

                                                    <div id="method" class="collapse one" data-parent="#accordion">
                                                        <div class="card-body1">
                                                            <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel-default">
                                                    <input id="payment_defult" name="check_method" type="radio" data-target="createp_account" />
                                                    <label for="payment_defult" data-toggle="collapse" data-target="#collapsedefult" aria-controls="collapsedefult">PayPal <img src="assets/img/icon/papyel.png" alt=""></label>

                                                    <div id="collapsedefult" class="collapse one" data-parent="#accordion">
                                                        <div class="card-body1">
                                                            <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="order_button">
                                                    <button type="submit" @click.prevent="orderPlaced()">Proceed to PayPal</button>
                                                </div>
                                            </div>

                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--Checkout page section end-->
    </div>
</template>

<script>
import topPart from "./Header.vue"
export default {
    name: 'checkout',
    data () {
        return {
            form: new Form({
                name: '',
                company_name: '',
                country: '',
                city: '',
                address: '',
                apartment: '',
                phone: '',
                email: '',
                password: '',
                order_notes: '',
            })
        }
    },
    components:{
        topPart
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
        orderPlaced(){
            this.form.post('place/order')
            .then(({ response }) => {
                this.$router.push('/');

                // toast.fire({
                //     icon: 'success',
                //     title: 'Order Placed'
                // })

                swal.fire({
                    icon: 'success',
                    title: 'Done',
                    text: 'Your Order has been placed',
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

<style scoped>

</style>
