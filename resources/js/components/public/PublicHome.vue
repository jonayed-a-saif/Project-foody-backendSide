<template>
    <div>
        <topPart></topPart>
        <!--slider area start-->
        <section class="slider_section slider_s_three mb-60 mt-20">
            <div class="slider_area slider3_carousel owl-carousel">

                <div class="single_slider d-flex align-items-center" :style="'background: url('+'/slider_images/'+`${slider.image}`+');background-postion:center center;background-size:cover'" v-for="slider in getAllSlider" :key="slider.id">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 offset-lg-2">
                                <div class="slider_content slider_c_three color_white">
                                    <h3 :style="{ color: slider.subtitle_color }">{{slider.subtitle}}</h3>
                                    <h1 :style="{ color: slider.title_color }">{{slider.title}}</h1>
                                    <p :style="{ color: slider.text_color }">{{slider.text}}</p>
                                    <a class="button" :href="`${slider.link}`" target="_blank">DISCOVER NOW</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!--slider area end-->

        <!--shipping area start-->
        <div class="shipping_area mb-60">
            <div class="container">
                <div class="shipping_inner">
                    <div class="single_shipping">
                        <div class="shipping_icone">
                            <img src="assets/public/assets/img/about/shipping1.png" alt="">
                        </div>
                        <div class="shipping_content">
                            <h4>Faster Delivery</h4>
                            <p>For all oders</p>
                        </div>
                    </div>
                    <div class="single_shipping">
                        <div class="shipping_icone">
                            <img src="assets/public/assets/img/about/shipping2.png" alt="">
                        </div>
                        <div class="shipping_content">
                            <h4>Online Payment</h4>
                            <p>For online oders</p>
                        </div>
                    </div>
                    <div class="single_shipping">
                        <div class="shipping_icone">
                            <img src="assets/public/assets/img/about/shipping3.png" alt="">
                        </div>
                        <div class="shipping_content">
                            <h4>Secured Payment</h4>
                            <p>For you transation</p>
                        </div>
                    </div>
                    <div class="single_shipping">
                        <div class="shipping_icone">
                            <img src="assets/public/assets/img/about/shipping4.png" alt="">
                        </div>
                        <div class="shipping_content">
                            <h4>Online Support</h4>
                            <p>For any problem</p>
                        </div>
                    </div>
                    <div class="single_shipping">
                        <div class="shipping_icone">
                            <img src="assets/public/assets/img/about/shipping5.png" alt="">
                        </div>
                        <div class="shipping_content">
                            <h4>Secured Data</h4>
                            <p>For all customers</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--shipping area end-->


        <!--banner top area start-->
        <div class="banner_area banner_three_bottom mb-60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6" v-for="poster in getAllPosters" :key="poster.id">
                        <figure class="single_banner" v-if="poster.position=='top'">
                            <div class="banner_thumb">
                                <a :href="`${poster.link}`" target="_blank"><img :src="posterImage(poster.image)" alt=""></a>
                            </div>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
        <!--banner top area end-->

        <!--home section bg area start-->
        <div class="home_section_bg">

            <!--Categories product area start-->
            <div class="categories_product_area mb-55">
                <div class="container">
                    <div class="categories_product_inner">

                        <div class="single_categories_product" v-for="category in getCategoryForProduct" :key="category.id">
                            <div class="categories_product_content">
                                <h4><a href="shop.html">{{category.name}}</a></h4>
                                <!-- <p>{{ convertToSome(category.id) }} Products</p> -->
                            </div>
                            <div class="categories_product_thumb">
                                <a href="shop.html"><img :src="categoryImage(category.image)" alt=""></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--Categories product area end-->

            <!--deals of the month product area start-->
            <div class="product_area" v-if="allProductsForDealsFrontend.length > 0">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="product_header">
                                <div class="section_title s_title_style3">
                                    <h2>Deals of the Month</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="Computer3" role="tabpanel">
                            <div class="product_carousel product_style product_column5 owl-carousel">
                                <article class="single_product" v-for="product in allProductsForDealsFrontend" :key="product.id">
                                    <figure>
                                        <div class="product_thumb">
                                            <router-link :to="`/product-details/${product.slug}`" class="primary_img"><img :src="productImage(product.image)" alt=""></router-link>
                                            <div class="label_product">
                                                <span class="label_sale">deal</span>
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
                                                <h4 class="product_name"><router-link :to="`/product-details/${product.slug}`">{{product.name}}</router-link></h4>
                                                <div class="price_box">
                                                    <span class="old_price">৳ {{product.prev_price}}</span>
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
                                    </figure>
                                </article>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--deals of the month  product area end-->

            <!--featured product area start-->
            <div class="product_area" v-if="allProductsForFeaturedFrontend.length > 0">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="product_header">
                                <div class="section_title s_title_style3">
                                    <h2>Featured Products</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="Computer3" role="tabpanel">
                            <div class="product_carousel product_style product_column5 owl-carousel">
                                <article class="single_product" v-for="product in allProductsForFeaturedFrontend" :key="product.id">
                                    <figure>
                                        <div class="product_thumb">
                                            <router-link :to="`/product-details/${product.slug}`" class="primary_img"><img :src="productImage(product.image)" alt=""></router-link>
                                            <div class="label_product">
                                                <span class="label_sale">Feature</span>
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
                                                <h4 class="product_name"><router-link :to="`/product-details/${product.slug}`">Natus erro at congue massa commodo sit Natus erro</router-link></h4>
                                                <div class="price_box">
                                                    <span class="old_price">$80.00</span>
                                                    <span class="current_price">$70.00</span>
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
                                    </figure>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--featured product area end-->

            <!--trending product area start-->
            <div class="product_area" v-if="allProductsForTrendingFrontend.length > 0">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="product_header">
                                <div class="section_title s_title_style3">
                                    <h2>Trending Products</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="Computer3" role="tabpanel">
                            <div class="product_carousel product_style product_column5 owl-carousel">
                                <article class="single_product" v-for="product in allProductsForTrendingFrontend" :key="product.id">
                                    <figure>
                                        <div class="product_thumb">
                                            <router-link :to="`/product-details/${product.slug}`" class="primary_img"><img :src="productImage(product.image)" alt=""></router-link>
                                            <div class="label_product">
                                                <span class="label_sale">Trend</span>
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
                                                <h4 class="product_name"><router-link :to="`/product-details/${product.slug}`">Natus erro at congue massa commodo sit Natus erro</router-link></h4>
                                                <div class="price_box">
                                                    <span class="old_price">$80.00</span>
                                                    <span class="current_price">$70.00</span>
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
                                    </figure>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--trending product area end-->

            <!--New product area start-->
            <div class="product_area" v-if="allProductsForNewFrontend.length > 0">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="product_header">
                                <div class="section_title s_title_style3">
                                    <h2>New Arrival</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="Computer3" role="tabpanel">
                            <div class="product_carousel product_style product_column5 owl-carousel">
                                <article class="single_product" v-for="product in allProductsForNewFrontend" :key="product.id">
                                    <figure>
                                        <div class="product_thumb">
                                            <router-link :to="`/product-details/${product.slug}`" class="primary_img"><img :src="productImage(product.image)" alt=""></router-link>
                                            <div class="label_product">
                                                <span class="label_sale">New</span>
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
                                                <h4 class="product_name"><router-link :to="`/product-details/${product.slug}`">Natus erro at congue massa commodo sit Natus erro</router-link></h4>
                                                <div class="price_box">
                                                    <span class="old_price">$80.00</span>
                                                    <span class="current_price">$70.00</span>
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
                                    </figure>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--New product area end-->

            <!--top product area start-->
            <div class="product_area" v-if="allProductsForTopFrontend.length > 0">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="product_header">
                                <div class="section_title s_title_style3">
                                    <h2>Top Rated</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="Computer3" role="tabpanel">
                            <div class="product_carousel product_style product_column5 owl-carousel">
                                <article class="single_product" v-for="product in allProductsForTopFrontend" :key="product.id">
                                    <figure>
                                        <div class="product_thumb">
                                            <router-link :to="`/product-details/${product.slug}`" class="primary_img"><img :src="productImage(product.image)" alt=""></router-link>
                                            <div class="label_product">
                                                <span class="label_sale">Top</span>
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
                                                <h4 class="product_name"><router-link :to="`/product-details/${product.slug}`">Natus erro at congue massa commodo sit Natus erro</router-link></h4>
                                                <div class="price_box">
                                                    <span class="old_price">$80.00</span>
                                                    <span class="current_price">$70.00</span>
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
                                    </figure>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--top product area end-->

            <!--flash product area start-->
            <div class="product_area" v-if="allProductsForSaleFrontend.length > 0">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="product_header">
                                <div class="section_title s_title_style3">
                                    <h2>Flash Sale</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="Computer3" role="tabpanel">
                            <div class="product_carousel product_style product_column5 owl-carousel">
                                <article class="single_product" v-for="product in allProductsForSaleFrontend" :key="product.id">
                                    <figure>
                                        <div class="product_thumb">
                                            <router-link :to="`/product-details/${product.slug}`" class="primary_img"><img :src="productImage(product.image)" alt=""></router-link>
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
                                                <h4 class="product_name"><router-link :to="`/product-details/${product.slug}`">Natus erro at congue massa commodo sit Natus erro</router-link></h4>
                                                <div class="price_box">
                                                    <span class="old_price">$80.00</span>
                                                    <span class="current_price">$70.00</span>
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
                                    </figure>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--flash product area end-->

            <!--blog area start-->
            <div class="blog_area">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="section_title s_title_style3">
                                <h2>Our Latest Posts</h2>
                            </div>
                            <div class="blog_container blog_column4 owl-carousel">
                                <article class="single_blog" v-for="blog in allBlogsForFrontend" :key="blog.id">
                                    <figure>
                                        <div class="blog_thumb">
                                            <a href="blog-details.html"><img :src="blogImage(blog.image)"></a>
                                        </div>
                                        <figcaption class="blog_content">
                                            <h4><a href="blog-details.html">{{blog.title}}</a></h4>
                                            <div class="post_meta">
                                                <p>By <a href="#">{{blog.user_name}}</a></p><p> Date : <a href="#">{{blog.created_at | timeformat2}}</a></p>
                                            </div>
                                            <!-- <div class="post_desc">
                                                <p v-html="blog.details"></p>
                                            </div> -->
                                            <footer class="post_readmore">
                                                <a href="#">Read more</a>
                                            </footer>
                                        </figcaption>
                                    </figure>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--blog area end-->

        </div>
        <!--home section bg area end-->

        <!--banner bottom area start-->
        <div class="banner_area banner_three_bottom mb-60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6" v-for="poster in getAllPosters" :key="poster.id">
                        <figure class="single_banner" v-if="poster.position=='bottom'">
                            <div class="banner_thumb">
                                <a :href="`${poster.link}`" target="_blank"><img :src="posterImage(poster.image)" alt=""></a>
                            </div>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
        <!--banner bottom area end-->


        <!-- modal area start-->
        <div class="modal fade" id="modal_box" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal_body">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <div class="modal_tab">
                                        <div class="tab-content product-details-large">
                                            <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                                                <div class="modal_tab_img">
                                                    <a href="#"><img src="assets/public/assets/img/product/productbig2.jpg" alt=""></a>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="tab2" role="tabpanel">
                                                <div class="modal_tab_img">
                                                    <a href="#"><img src="assets/public/assets/img/product/productbig3.jpg" alt=""></a>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="tab3" role="tabpanel">
                                                <div class="modal_tab_img">
                                                    <a href="#"><img src="assets/public/assets/img/product/productbig4.jpg" alt=""></a>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="tab4" role="tabpanel">
                                                <div class="modal_tab_img">
                                                    <a href="#"><img src="assets/public/assets/img/product/productbig5.jpg" alt=""></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal_tab_button">
                                            <ul class="nav product_navactive owl-carousel" role="tablist">
                                                <li>
                                                    <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="false"><img src="assets/public/assets/img/product/product1.jpg" alt=""></a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false"><img src="assets/public/assets/img/product/product6.jpg" alt=""></a>
                                                </li>
                                                <li>
                                                    <a class="nav-link button_three" data-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false"><img src="assets/public/assets/img/product/product9.jpg" alt=""></a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" data-toggle="tab" href="#tab4" role="tab" aria-controls="tab4" aria-selected="false"><img src="assets/public/assets/img/product/product14.jpg" alt=""></a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-12">
                                    <div class="modal_right">
                                        <div class="modal_title mb-10">
                                            <h2>Sit voluptatem rhoncus sem lectus</h2>
                                        </div>
                                        <div class="modal_price mb-10">
                                            <span class="new_price">$64.99</span>
                                            <span class="old_price" >$78.99</span>
                                        </div>
                                        <div class="modal_description mb-15">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia iste laborum ad impedit pariatur esse optio tempora sint ullam autem deleniti nam in quos qui nemo ipsum numquam, reiciendis maiores quidem aperiam, rerum vel recusandae </p>
                                        </div>
                                        <div class="variants_selects">
                                            <div class="variants_size">
                                                <h2>size</h2>
                                                <select class="select_option">
                                                    <option selected value="1">s</option>
                                                    <option value="1">m</option>
                                                    <option value="1">l</option>
                                                    <option value="1">xl</option>
                                                    <option value="1">xxl</option>
                                                </select>
                                            </div>
                                            <div class="variants_color">
                                                <h2>color</h2>
                                                <select class="select_option">
                                                    <option selected value="1">purple</option>
                                                    <option value="1">violet</option>
                                                    <option value="1">black</option>
                                                    <option value="1">pink</option>
                                                    <option value="1">orange</option>
                                                </select>
                                            </div>
                                            <div class="modal_add_to_cart">
                                                <form action="#">
                                                    <input min="1" max="100" step="2" value="1" type="number">
                                                    <button type="submit">add to cart</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="modal_social">
                                            <h2>Share this product</h2>
                                            <ul>
                                                <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                <li class="pinterest"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                                <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                                <li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal area end-->

    </div>
</template>

<script>
import topPart from "./Header.vue"
export default {
    name: "PublicHome",
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
    mounted() {

        // let recaptchaScript = document.createElement('script')
        // recaptchaScript.setAttribute('src', 'assets/public/assets/js/plugins.js')
        // document.head.appendChild(recaptchaScript)

        // let recaptchaScript2 = document.createElement('script')
        // recaptchaScript2.setAttribute('src', 'assets/public/assets/js/main.js')
        // document.head.appendChild(recaptchaScript2)

        this.$store.dispatch('allSliders')
        this.$store.dispatch('allPosters')
        this.$store.dispatch("allCategoryForNewProduct")
        this.$store.dispatch("frontendDealsProducts")
        this.$store.dispatch("frontendFeaturedProducts")
        this.$store.dispatch("frontendTrendingProducts")
        this.$store.dispatch("frontendNewProducts")
        this.$store.dispatch("frontendTopProducts")
        this.$store.dispatch("frontendSaleProducts")
        this.$store.dispatch("frontendAllBlogs")
        this.$store.dispatch('totalCartAmount')
    },
    computed:{
        getAllSlider(){
            return this.$store.getters.getSlider
        },
        getAllPosters(){
            return this.$store.getters.getPoster
        },
        getCategoryForProduct(){
            return this.$store.getters.getCategoryForProduct
        },
        allProductsForDealsFrontend(){
            return this.$store.getters.getAllProductsForFrontendDeals
        },
        allProductsForFeaturedFrontend(){
            return this.$store.getters.getAllProductsForFrontendFeatured
        },
        allProductsForTrendingFrontend(){
            return this.$store.getters.getAllProductsForFrontendTrending
        },
        allProductsForNewFrontend(){
            return this.$store.getters.getAllProductsForFrontendNew
        },
        allProductsForTopFrontend(){
            return this.$store.getters.getAllProductsForFrontendTop
        },
        allProductsForSaleFrontend(){
            return this.$store.getters.getAllProductsForFrontendSale
        },
        allBlogsForFrontend(){
            return this.$store.getters.getAllBlogsForFrontend
        },
        viewTotalCartAmount(){
            return this.$store.getters.getTotalCartAmount
        }
    },
    methods:{
        posterImage(img){
            return "poster_images/"+img;
        },
        categoryImage(img){
            return "category_images/"+img;
        },
        productImage(img){
            return "product_images/"+img;
        },
        blogImage(img){
            return "blog_images/"+img;
        },
        blogDetails(Text){
            return Text
        },
        addToCart($slug){
            axios.get('/get/product/details/for/cart/'+$slug)
            .then((response)=>{
                this.form.fill(response.data.product)
                this.form.stock = 1
                this.form.post('/add/product/to/cart')
                .then(({ response }) => {
                    this.$router.push('/');

                    this.$store.dispatch("frontendDealsProducts")
                    this.$store.dispatch("frontendFeaturedProducts")
                    this.$store.dispatch("frontendTrendingProducts")
                    this.$store.dispatch("frontendNewProducts")
                    this.$store.dispatch("frontendTopProducts")
                    this.$store.dispatch("frontendSaleProducts")
                    this.$store.dispatch("frontendAllBlogs")
                    this.$store.dispatch('totalCartAmount')

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
        // convertToSome($id){
        //     var numberOfProduct;
        //     axios.get("/products/under/category/"+$id)
        //     .then((response)=>{
        //         numberOfProduct = response.data
        //     })
        //     .catch(()=>{
        //         console.log("Error1")
        //     })
        //     return numberOfProduct
        // }
    }
}
</script>

<style scoped>

</style>
