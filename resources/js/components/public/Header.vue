<template>
    <div>
        <header>
            <div class="main_header">
                <div class="container">
                    <!--header top start-->
                    <div class="header_top">
                        <div class="row align-items-center">
                            <div class="col-lg-4 col-md-5">
                                <div class="antomi_message">
                                    <p>Get free shipping – Free 30 day money back guarantee</p>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-7">
                                <div class="header_top_settings text-right">
                                    <ul>
                                        <li><a href="#">Store Locations</a></li>
                                        <li><a href="#">Track Your Order</a></li>
                                        <li>Hotline: <a href="tel:+(012)800456789">(012) 800 456 789 </a></li>
                                        <li>Quality Guarantee Of Products</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--header top start-->

                    <!--header middel start-->
                    <div class="header_middle sticky-header">
                        <div class="row align-items-center">
                            <div class="col-lg-2 col-md-3 col-4">
                                <div class="logo">
                                    <a href="#"><img src="assets/public/assets/img/logo/logo.png" alt="Logo Here"></a>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-12">
                                <div class="main_menu menu_position text-center">
                                    <nav>
                                        <ul>
                                            <li><router-link to="/" class="active">home</router-link></li>
                                            <li class="mega_items"><router-link to="/shop">shop</router-link></li>
                                            <li><a href="blog.html">blog<i class="fa fa-angle-down"></i></a>
                                                <ul class="sub_menu pages">
                                                    <li><a href="blog-details.html">blog details</a></li>
                                                    <li><a href="blog-fullwidth.html">blog fullwidth</a></li>
                                                    <li><a href="blog-sidebar.html">blog sidebar</a></li>
                                                    <li><a href="blog-no-sidebar.html">blog no sidebar</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">pages <i class="fa fa-angle-down"></i></a>
                                                <ul class="sub_menu pages">
                                                    <li><a href="about.html">About Us</a></li>
                                                    <li><a href="faq.html">Frequently Questions</a></li>
                                                    <li><a href="privacy-policy.html">privacy policy</a></li>
                                                    <li><a href="contact.html">contact</a></li>
                                                    <li><a href="login.html">login</a></li>
                                                    <li><a href="404.html">Error 404</a></li>
                                                    <li><a href="compare.html">compare</a></li>
                                                    <li><a href="coming-soon.html">coming soon</a></li>
                                                </ul>
                                            </li>

                                            <li><a href="about.html">About Us</a></li>
                                            <li><a href="contact.html"> Contact Us</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-7 col-6">
                                <div class="header_configure_area">
                                    <div class="header_wishlist">
                                        <a href="wishlist.html"><i class="ion-android-favorite-outline"></i>
                                            <span class="wishlist_count">3</span>
                                        </a>
                                    </div>
                                    <div class="mini_cart_wrapper">
                                        <a href="javascript:void(0)">
                                            <i class="fa fa-shopping-bag"></i>
                                            <span class="cart_price">৳ {{viewTotalCartAmount}}<i class="ion-ios-arrow-down"></i></span>
                                            <span class="cart_count">{{viewTotalCartQty}}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--header middel end-->

                    <!--mini cart-->
                    <div class="mini_cart">
                        <div class="cart_close">
                            <div class="cart_text">
                                <h3>cart</h3>
                            </div>
                            <div class="mini_cart_close">
                                <a href="javascript:void(0)"><i class="ion-android-close"></i></a>
                            </div>
                        </div>

                        <div class="cart_item" v-for="cart in viewTotalCartInfo" :key="cart.id">
                            <div class="cart_img">
                                <router-link :to="`/product-details/${cart.product_slug}`"><img :src="`/product_images/${cart.product_image}`" alt="ProductImage"></router-link>
                            </div>
                            <div class="cart_info">
                                <router-link :to="`/product-details/${cart.product_slug}`">{{cart.product_name}}</router-link>
                                <p>Qty: {{cart.qty}} X <span> ৳ {{cart.price}} </span></p>
                            </div>
                            <div class="cart_remove">
                                <a href="#" @click.prevent="deleteCartItem(cart.id)"><i class="ion-android-close"></i></a>
                            </div>
                        </div>

                        <div class="mini_cart_table">
                            <div class="cart_total">
                                <span>Sub total:</span>
                                <span class="price">৳ {{viewTotalCartAmount}}</span>
                            </div>
                            <!-- <div class="cart_total mt-10">
                                <span>total:</span>
                                <span class="price">$138.00</span>
                            </div> -->
                        </div>
                        <div class="mini_cart_footer">
                            <div class="cart_button">
                                <router-link to="/cart">View cart</router-link>
                            </div>
                            <div class="cart_button">
                                <router-link to="/checkout">Checkout</router-link>
                            </div>
                        </div>
                    </div>
                    <!--mini cart end-->

                    <!--header bottom satrt-->
                    <div class="header_bottom">
                        <div class="row align-items-center">
                            <div class="column1 col-lg-3 col-md-6">
                                <div class="categories_menu categories_three">
                                    <div class="categories_title">
                                        <h2 class="categori_toggle">ALL CATEGORIES</h2>
                                    </div>
                                    <div class="categories_menu_toggle">
                                        <ul>
                                            <li class="menu_item_children"><a href="#">Brake Parts <i class="fa fa-angle-right"></i></a>
                                                <ul class="categories_mega_menu">
                                                    <li class="menu_item_children"><a href="#">Dresses</a>
                                                        <ul class="categorie_sub_menu">
                                                            <li><a href="#">Sweater</a></li>
                                                            <li><a href="#">Evening</a></li>
                                                            <li><a href="#">Day</a></li>
                                                            <li><a href="#">Sports</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="menu_item_children"><a href="#">Handbags</a>
                                                        <ul class="categorie_sub_menu">
                                                            <li><a href="#">Shoulder</a></li>
                                                            <li><a href="#">Satchels</a></li>
                                                            <li><a href="#">kids</a></li>
                                                            <li><a href="#">coats</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="menu_item_children"><a href="#">shoes</a>
                                                        <ul class="categorie_sub_menu">
                                                            <li><a href="#">Ankle Boots</a></li>
                                                            <li><a href="#">Clog sandals </a></li>
                                                            <li><a href="#">run</a></li>
                                                            <li><a href="#">Books</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="menu_item_children"><a href="#">Clothing</a>
                                                        <ul class="categorie_sub_menu">
                                                            <li><a href="#">Coats Jackets </a></li>
                                                            <li><a href="#">Raincoats</a></li>
                                                            <li><a href="#">Jackets</a></li>
                                                            <li><a href="#">T-shirts</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu_item_children"><a href="#"> Wheels & Tires <i class="fa fa-angle-right"></i></a>
                                                <ul class="categories_mega_menu column_3">
                                                    <li class="menu_item_children"><a href="#">Chair</a>
                                                        <ul class="categorie_sub_menu">
                                                            <li><a href="#">Dining room</a></li>
                                                            <li><a href="#">bedroom</a></li>
                                                            <li><a href="#"> Home & Office</a></li>
                                                            <li><a href="#">living room</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="menu_item_children"><a href="#">Lighting</a>
                                                        <ul class="categorie_sub_menu">
                                                            <li><a href="#">Ceiling Lighting</a></li>
                                                            <li><a href="#">Wall Lighting</a></li>
                                                            <li><a href="#">Outdoor Lighting</a></li>
                                                            <li><a href="#">Smart Lighting</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="menu_item_children"><a href="#">Sofa</a>
                                                        <ul class="categorie_sub_menu">
                                                            <li><a href="#">Fabric Sofas</a></li>
                                                            <li><a href="#">Leather Sofas</a></li>
                                                            <li><a href="#">Corner Sofas</a></li>
                                                            <li><a href="#">Sofa Beds</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu_item_children"><a href="#"> Furnitured & Decor <i class="fa fa-angle-right"></i></a>
                                                <ul class="categories_mega_menu column_2">
                                                    <li class="menu_item_children"><a href="#">Brake Tools</a>
                                                        <ul class="categorie_sub_menu">
                                                            <li><a href="#">Driveshafts</a></li>
                                                            <li><a href="#">Spools</a></li>
                                                            <li><a href="#">Diesel </a></li>
                                                            <li><a href="#">Gasoline</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="menu_item_children"><a href="#">Emergency Brake</a>
                                                        <ul class="categorie_sub_menu">
                                                            <li><a href="#">Dolls for Girls</a></li>
                                                            <li><a href="#">Girls' Learning Toys</a></li>
                                                            <li><a href="#">Arts and Crafts for Girls</a></li>
                                                            <li><a href="#">Video Games for Girls</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu_item_children"><a href="#"> Turbo System <i class="fa fa-angle-right"></i></a>
                                                <ul class="categories_mega_menu column_2">
                                                    <li class="menu_item_children"><a href="#">Check Trousers</a>
                                                        <ul class="categorie_sub_menu">
                                                            <li><a href="#">Building</a></li>
                                                            <li><a href="#">Electronics</a></li>
                                                            <li><a href="#">action figures </a></li>
                                                            <li><a href="#">specialty & boutique toy</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="menu_item_children"><a href="#">Calculators</a>
                                                        <ul class="categorie_sub_menu">
                                                            <li><a href="#">Dolls for Girls</a></li>
                                                            <li><a href="#">Girls' Learning Toys</a></li>
                                                            <li><a href="#">Arts and Crafts for Girls</a></li>
                                                            <li><a href="#">Video Games for Girls</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="#"> Lighting</a></li>
                                            <li><a href="#"> Accessories</a></li>
                                            <li><a href="#">Body Parts</a></li>
                                            <li><a href="#">Networking</a></li>
                                            <li><a href="#">Perfomance Filters</a></li>
                                            <li><a href="#"> Engine Parts</a></li>
                                            <li class="hidden"><a href="#">New Sofas</a></li>
                                            <li class="hidden"><a href="#">Sleight Sofas</a></li>
                                            <li><a href="#" id="more-btn"><i class="fa fa-plus" aria-hidden="true"></i> More Categories</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="column2 col-lg-6 ">
                                <div class="search_container">
                                    <form action="#">
                                        <div class="hover_category">
                                            <select class="select_option" name="select" id="categori2">
                                                <option selected value="1">All Categories</option>
                                                <option value="2">Accessories</option>
                                                <option value="3">Accessories & More</option>
                                                <option value="4">Butters & Eggs</option>
                                                <option value="5">Camera & Video </option>
                                                <option value="6">Mornitors</option>
                                                <option value="7">Tablets</option>
                                                <option value="8">Laptops</option>
                                                <option value="9">Handbags</option>
                                                <option value="10">Headphone & Speaker</option>
                                                <option value="11">Herbs & botanicals</option>
                                                <option value="12">Vegetables</option>
                                                <option value="13">Shop</option>
                                                <option value="14">Laptops & Desktops</option>
                                                <option value="15">Watchs</option>
                                                <option value="16">Electronic</option>
                                            </select>
                                        </div>
                                        <div class="search_box">
                                            <input placeholder="Search product..." type="text">
                                            <button type="submit">Search</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <div class="column3 col-lg-3 col-md-6">
                                <div class="header_bigsale">
                                    <a href="#">BIG SALE BLACK FRIDAY</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--header bottom end-->
                </div>
            </div>
        </header>
    </div>
</template>

<script>
export default {
    name: 'header',
    mounted() {

        let recaptchaScript = document.createElement('script')
        recaptchaScript.setAttribute('src', 'assets/public/assets/js/plugins.js')
        document.body.appendChild(recaptchaScript)

        let recaptchaScript2 = document.createElement('script')
        recaptchaScript2.setAttribute('src', 'assets/public/assets/js/main.js')
        document.body.appendChild(recaptchaScript2)

        this.$store.dispatch('totalCartAmount')
        this.$store.dispatch('totalCartQty')
        this.$store.dispatch('totalCartInfo')
    },
    computed:{
        viewTotalCartAmount(){
            return this.$store.getters.getTotalCartAmount
        },
        viewTotalCartQty(){
            return this.$store.getters.getTotalCartQty
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
                    // toast.fire({
                    //     icon: 'success',
                    //     title: 'Payment Deleted successfully'
                    // })
                })
                .catch(()=>{
                    toast.fire({
                        icon: 'error',
                        text: 'Something went wrong',
                    })
                })
        },
    }
}
</script>

<style scoped>

</style>
