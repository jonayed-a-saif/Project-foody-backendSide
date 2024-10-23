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
                                    <li>product variable</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!--breadcrumbs area end-->

        <div class="product_page_bg">
        <div class="container">

            <div class="product_details_wrapper mb-55">
                <!--product details start-->
                <div class="product_details">
                    <div class="row">
                        <div class="col-lg-5 col-md-6">
                            <div class="product-details-tab">
                                <div id="img-1" class="zoomWrapper single-zoom">
                                    <a href="#">
                                        <img id="zoom1" :src="`/product_images/${viewpProductDetails.image}`" :data-zoom-image="`/product_images/${viewpProductDetails.image}`" alt="Product-Image">
                                    </a>
                                </div>
                                <div class="single-zoom-thumb">
                                    <ul class="single-product-active" id="gallery_01">

                                        <!-- <li v-for="photo in JSON.parse(viewpProductDetails.photos)" :key="photo.id">
                                            <a href="#" data-update="" :data-image="`/product_images/${photo}`" :data-zoom-image="`/product_images/${photo}`">
                                                <img :src="`/product_images/${photo}`" alt="zo-th-1"/>
                                            </a>
                                        </li> -->

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6">
                            <div class="product_d_right">
                                <form action="#">
                                    <h3><a href="#">{{viewpProductDetails.name}}</a></h3>
                                    <div class="product_rating">
                                        <ul>
                                            <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                            <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                            <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                            <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                            <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                            <li class="review"><a href="#">(1 customer review )</a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="old_price">৳ {{viewpProductDetails.prev_price}}</span>
                                        <span class="current_price">৳ {{viewpProductDetails.price}}</span>
                                    </div>
                                    <!-- <div class="product_variant color">
                                        <h3>Available Options</h3>
                                        <label>color</label>
                                        <ul>
                                            <li class="color1"><a href="#"></a></li>
                                            <li class="color2"><a href="#"></a></li>
                                            <li class="color3"><a href="#"></a></li>
                                            <li class="color4"><a href="#"></a></li>
                                        </ul>
                                    </div> -->
                                    <!-- <div class="product_variant size">
                                        <label>size</label>
                                        <select class="niceselect_option" id="color2" name="produc_color2">
                                            <option selected value="1"> size in option</option>
                                            <option value="2">s</option>
                                            <option value="3">m</option>
                                            <option value="4">l</option>
                                            <option value="5">xl</option>
                                            <option value="6">xxl</option>
                                        </select>
                                    </div> -->
                                    <div class="product_variant quantity">
                                        <form role="form" enctype="multipart/form-data" @submit.prevent="addProductToCart()">
                                            <input type="hidden" v-model="form.id" name="id" :class="{ 'is-invalid': form.errors.has('id') }">
                                            <has-error :form="form" field="id"></has-error>

                                            <input type="hidden" v-model="form.price" name="price" :class="{ 'is-invalid': form.errors.has('price') }">
                                            <has-error :form="form" field="price"></has-error>

                                            <input type="hidden" v-model="form.color" name="color" :class="{ 'is-invalid': form.errors.has('color') }">
                                            <has-error :form="form" field="color"></has-error>

                                            <input type="hidden" v-model="form.size" name="size" :class="{ 'is-invalid': form.errors.has('size') }">
                                            <has-error :form="form" field="size"></has-error>

                                            <label>quantity</label>
                                            <input v-model="form.stock" name="stock" min="1" value="1" type="number">
                                            <button class="button" type="submit" v-if="viewpProductDetails.stock > 0">add to cart</button>
                                            <button class="button" type="submit" v-else>Stock Out</button>
                                        </form>
                                    </div>
                                    <div class=" product_d_action">
                                        <ul>
                                            <li><a href="#" title="Add to wishlist">+ Add to Wishlist</a></li>
                                            <li><a href="#" title="Add to wishlist">+ Compare</a></li>
                                        </ul>
                                    </div>
                                </form>
                                <div class="product_d_meta">
                                    <span>Stock: {{viewpProductDetails.stock}}</span>
                                    <span>Category: <a href="#">{{viewpProductDetails.category_name}}</a></span>
                                    <span>Vendor: <a href="#">{{viewpProductDetails.user_name}}</a></span>
                                    <span>Visitor: <a href="#">10</a></span>
                                    <span>Tags:
                                        <a href="#">Creams</a>
                                        <a href="#">Lotions</a>
                                    </span>
                                </div>
                                <div class="priduct_social">
                                    <ul>
                                        <li><a class="facebook" href="#" title="facebook"><i class="fa fa-facebook"></i> Like</a></li>
                                        <li><a class="twitter" href="#" title="twitter"><i class="fa fa-twitter"></i> tweet</a></li>
                                        <li><a class="pinterest" href="#" title="pinterest"><i class="fa fa-pinterest"></i> save</a></li>
                                        <li><a class="google-plus" href="#" title="google +"><i class="fa fa-google-plus"></i> share</a></li>
                                        <li><a class="linkedin" href="#" title="linkedin"><i class="fa fa-linkedin"></i> linked</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--product details end-->

                <!--product info start-->
                <div class="product_d_info">
                    <div class="row">
                        <div class="col-12">
                            <div class="product_d_inner">
                                <div class="product_info_button">
                                    <ul class="nav" role="tablist">
                                        <li v-if="viewpProductDetails.description != null">
                                            <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Description</a>
                                        </li>
                                        <li v-if="viewpProductDetails.policy != null">
                                            <a data-toggle="tab" href="#sheet" role="tab" aria-controls="sheet" aria-selected="false">Policy</a>
                                        </li>
                                        <!-- <li>
                                            <a data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews (1)</a>
                                        </li> -->
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="info" role="tabpanel">
                                        <div class="product_info_content" v-html="viewpProductDetails.description">
                                            <!-- decription will show here by v-html render used above -->
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="sheet" role="tabpanel">
                                        <div class="product_info_content" v-html="viewpProductDetails.policy">
                                            <!-- policy will show here by v-html render used above -->
                                        </div>
                                    </div>

                                    <!-- <div class="tab-pane fade" id="reviews" role="tabpanel">
                                        <div class="reviews_wrapper">
                                            <h2>1 review for Donec eu furniture</h2>
                                            <div class="reviews_comment_box">
                                                <div class="comment_thmb">
                                                    <img src="assets/img/blog/comment2.jpg" alt="">
                                                </div>
                                                <div class="comment_text">
                                                    <div class="reviews_meta">
                                                        <div class="product_rating">
                                                            <ul>
                                                                <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                                <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                                <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                                <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                                <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <p><strong>admin </strong>- September 12, 2018</p>
                                                        <span>roadthemes</span>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="comment_title">
                                                <h2>Add a review </h2>
                                                <p>Your email address will not be published. Required fields are marked </p>
                                            </div>
                                            <div class="product_rating mb-10">
                                                <h3>Your rating</h3>
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="product_review_form">
                                                <form action="#">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label for="review_comment">Your review </label>
                                                            <textarea name="comment" id="review_comment"></textarea>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <label for="author">Name</label>
                                                            <input id="author" type="text">

                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <label for="email">Email </label>
                                                            <input id="email" type="text">
                                                        </div>
                                                    </div>
                                                    <button type="submit">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--product info end-->
            </div>

            <!--product area start-->
            <!-- <section class="product_area related_products">
                <div class="row">
                    <div class="col-12">
                        <div class="section_title">
                            <h2>Related Products </h2>
                        </div>
                    </div>
                </div>
                <div class="product_carousel product_style product_column5 owl-carousel">
                    <article class="single_product">
                        <figure>

                            <div class="product_thumb">
                                <a class="primary_img" href="product-details.html"><img src="assets/img/product/product14.jpg" alt=""></a>
                                <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product13.jpg" alt=""></a>
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
                            <div class="product_content">
                                <div class="product_content_inner">
                                    <h4 class="product_name"><a href="product-details.html">Natus erro at congue massa commodo sit Natus erro</a></h4>
                                    <div class="price_box">
                                        <span class="old_price">$80.00</span>
                                        <span class="current_price">$70.00</span>
                                    </div>
                                </div>
                                <div class="add_to_cart">
                                    <a href="cart.html" title="Add to cart">Add to cart</a>
                                </div>

                            </div>
                        </figure>
                    </article>
                    <article class="single_product">
                        <figure>

                            <div class="product_thumb">
                                <a class="primary_img" href="product-details.html"><img src="assets/img/product/product17.jpg" alt=""></a>
                                <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product18.jpg" alt=""></a>
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
                            <div class="product_content">
                                <div class="product_content_inner">
                                    <h4 class="product_name"><a href="product-details.html">Nullam maximus eget nisi dignissim sodales eget tempor</a></h4>
                                    <div class="price_box">
                                        <span class="old_price">$76.00</span>
                                        <span class="current_price">$75.00</span>
                                    </div>
                                </div>
                                <div class="add_to_cart">
                                    <a href="cart.html" title="Add to cart">Add to cart</a>
                                </div>

                            </div>
                        </figure>
                    </article>
                </div>

            </section> -->
            <!--product area end-->

        </div>
    </div>

    </div>
</template>

<script>
import topPart from "../Header.vue"
export default {
    name: "ProductDetails",
    components:{
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

        this.$store.dispatch('getProductDetailsBySlug',this.$route.params.productSlug)
        this.$store.dispatch('totalCartAmount')
        this.$store.dispatch('totalCartQty')
        this.$store.dispatch('totalCartInfo')

    },
    computed:{
        viewpProductDetails(){
            return this.$store.getters.getProductDetails
        }
    },
    created(){
        axios.get(`/get/product/details/for/cart/${this.$route.params.productSlug}`)
            .then((response)=>{
                this.form.fill(response.data.product)
                this.form.stock = 1
            })
            .catch(()=>{
                console.log("Error")
            })
    },
    methods:{
        addProductToCart(){
            this.form.post('/add/product/to/cart')
            .then(({ response }) => {
                this.$router.push('/product-details/'+this.$route.params.productSlug);
                this.$store.dispatch('getProductDetailsBySlug',this.$route.params.productSlug)
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
                    text: ' Stock Limit Exceed',
                })
            })
        }
    }
}
</script>

<style scoped>
ul.single-product-active li a img{
    width: 25% !important;
}
ul.single-product-active li{
    display: inline !important;
}
</style>
