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
                                <li>shop</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--breadcrumbs area end-->

        <!--shop  area start-->
        <div class="shop_area shop_reverse">
            <div class="container">
                <div class="row">
                    <ProductSideBar></ProductSideBar>
                    <div class="col-lg-9 col-md-12">

                        <!--shop banner area start-->
                        <div class="shop_banner_area mb-30">
                            <div class="row">
                                <div class="col-12">
                                    <div class="shop_banner_thumb">
                                        <img src="assets/public/assets/img/bg/banner16.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--shop banner area end-->

                        <!--shop toolbar start-->
                        <div class="shop_toolbar_wrapper">
                            <div class="shop_toolbar_btn">
                                <button data-role="grid_4" type="button" class=" active btn-grid-4" data-toggle="tooltip" title="4"></button>
                                <button data-role="grid_list" type="button" class="btn-list" data-toggle="tooltip" title="List"></button>
                            </div>
                            <div class=" niceselect_option">
                                <form class="select_option" action="#">
                                    <select name="orderby" id="short">

                                        <option selected value="1">Sort by average rating</option>
                                        <option value="2">Sort by popularity</option>
                                        <option value="3">Sort by newness</option>
                                        <option value="4">Sort by price: low to high</option>
                                        <option value="5">Sort by price: high to low</option>
                                        <option value="6">Product Name: Z</option>
                                    </select>
                                </form>
                            </div>
                            <div class="page_amount">
                                <p>Showing 1–9 of 21 results</p>
                            </div>
                        </div>
                        <!--shop toolbar end-->

                        <!--shop wrapper start-->
                        <div class="row no-gutters shop_wrapper">

                            <div class="col-lg-3 col-md-4 col-12" v-for="product in allProductsForFrontend" :key="product.id">
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <router-link :to="`/product-details/${product.slug}`" class="primary_img">
                                                <img :src="ourImage(product.image)" alt="">
                                            </router-link>
                                            <div class="label_product">
                                                <span class="label_sale">Sale</span>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="ion-android-favorite-outline"></i></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><i class="ion-ios-settings-strong"></i></a></li>
                                                    <li class="quick_button"><a href="#" data-toggle="modal" data-target="#modal_box" title="quick view"><i class="ion-ios-search-strong"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="product_content grid_content">
                                            <div class="product_content_inner">
                                                <h4 class="product_name"><router-link :to="`/product-details/${product.slug}`">{{product.name}}</router-link></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">৳{{product.prev_price}}</span>
                                                    <span class="current_price">৳ {{product.price}}</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <span v-if="product.stock > 0">
                                                    <a href="#" title="Add To Cart" @click.prevent="addToCart(product.slug)">Add To  Cart</a>
                                                </span>
                                                <span v-else>
                                                    <a href="#" title="Stock Out" @click.prevent="addToCart(product.slug)">Stock Out</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="product_content list_content">
                                            <h4 class="product_name"><router-link :to="`/product-details/${product.slug}`">{{product.name}}</router-link></h4>
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">৳{{product.prev_price}}</span>
                                                <span class="current_price">৳ {{product.price}}</span>
                                            </div>
                                            <div class="product_desc">
                                                <p>{{product.description | shortLength(20,"...")}}</p>
                                            </div>
                                            <div class="add_to_cart">
                                                <span v-if="product.stock > 0">
                                                    <a href="#" title="Add To Cart" @click.prevent="addToCart(product.slug)">Add To  Cart</a>
                                                </span>
                                                <span v-else>
                                                    <a href="#" title="Stock Out" @click.prevent="addToCart(product.slug)">Stock Out</a>
                                                </span>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="ion-android-favorite-outline"></i> Add to Wishlist</a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><i class="ion-ios-settings-strong"></i> Compare</a></li>
                                                    <li class="quick_button"><a href="#" data-toggle="modal" data-target="#modal_box" title="quick view"><i class="ion-ios-search-strong"></i> quick view</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </figure>
                                </article>
                            </div>

                        </div>

                        <div class="shop_toolbar t_bottom">
                            <div class="pagination">
                                <ul>
                                    <li class="current">1</li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li class="next"><a href="#">next</a></li>
                                    <li><a href="#">>></a></li>
                                </ul>
                            </div>
                        </div>
                        <!--shop wrapper end-->

                    </div>
                </div>
            </div>
        </div>
        <!--shop  area end-->

    </div>
</template>

<script>
import ProductSideBar from "./ProductSidebar.vue"
import topPart from "../Header.vue"
export default {
    name: "Shop",
    components:{
        ProductSideBar,
        topPart
    },
    data(){
        return{
            form: new Form({
                id: '',
                price: '',
                color: '',
                size: '',
                stock: ''
            })
        }
    },
    mounted(){

        this.$store.dispatch('frontendProducts')

        // let recaptchaScript = document.createElement('script')
        // recaptchaScript.setAttribute('src', 'assets/public/assets/js/plugins.js')
        // document.head.appendChild(recaptchaScript)

        // let recaptchaScript2 = document.createElement('script')
        // recaptchaScript2.setAttribute('src', 'assets/public/assets/js/main.js')
        // document.head.appendChild(recaptchaScript2)

    },
    computed:{
        allProductsForFrontend(){
            return this.$store.getters.getAllProductsForFrontend
        }
    },
    methods:{
        ourImage(img){
            return "product_images/"+img;
        },
        addToCart($slug){
            axios.get('/get/product/details/for/cart/'+$slug)
            .then((response)=>{
                this.form.fill(response.data.product)
                this.form.stock = 1
                this.form.post('/add/product/to/cart')
                .then(({ response }) => {
                    this.$router.push('/shop');

                    this.$store.dispatch('frontendProducts')

                    this.$store.dispatch('totalCartAmount')
                    this.$store.dispatch('totalCartQty')
                    this.$store.dispatch('totalCartInfo')

                    toast.fire({
                        icon: 'success',
                        title: 'Product Added to Cart'
                    })

                })
                .catch(()=>{
                    toast.fire({
                        icon: 'error',
                        text: 'Stock Out',
                    })
                })
            })
            .catch(()=>{
                console.log("Error")
            })
        }
    }
}
</script>

<style scoped>

</style>
