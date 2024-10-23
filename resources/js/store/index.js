import Axios from "axios"
import {get } from "jquery"

export default {
    state: {
        category: [],
        message: [],
        homecategory: [],
        homecategoryproduct: [],
        subcategory: [],
        childcategory: [],
        coupon: [],
        product: [],
        numberofproducts: [],
        numberofsentsms: [],
        categoryForProduct: [],
        blogCategory: [],
        blog: [],
        payment: [],
        sliders: [],
        posters: [],
        logoForFrontend: [],
        LoaderForBackend: [],
        ShippingMethodsForBackend: [],
        PackagingForBackend: [],
        PickupLocationForBackend: [],
        WebsiteColorForBackend: [],
        FooterForBackend: [],
        PopupBannerForBackend: [],
        ErrorBannerForBackend: [],
        pendingOrders: [],
        processingOrders: [],
        completeOrders: [],
        declinedOrders: [],
        aboutForbackend: [],
        stuffForBackend: [],
        CustomerForBackend: [],

        gettotalOrderforBackend: [],
        gettotalgetNumberofSentSms: [],
        gettotalgetNumberofRemainSms: [],
        gettotalAmountforBackend: [],
        gettotalCustomersforBackend: [],
        gettotalProductsforBackend: [],
        UserRoleForBackend: [],
        // frontend
        frontendProdcts: [],
        frontendDealsProdcts: [],
        frontendFeaturedProdcts: [],
        frontendTrendingProdcts: [],
        frontendNewProdcts: [],
        frontendTopProdcts: [],
        frontendSaleProdcts: [],
        frontendBlogs: [],
        singleProductDetails: [],
        cartAmountForFrontend: [],
        cartQtyForFrontend: [],
        cartInfoForFrontend: []
    },
    getters: {
        getCategory(state) {
            return state.category
        },
        getSms(state) {
            return state.message
        },
        getHomeCategory(state) {
            return state.homecategory 
        },
        getHomeCategoryProduct(state) {
            return state.homecategoryproduct 
        },
        getAllSubCategory(state) {
            return state.subcategory
        },
        getAllChildCategory(state) {
            return state.childcategory
        },
        getAllCoupon(state) {
            return state.coupon
        },
        getAllPayment(state) {
            return state.payment
        },
        getAllBlogCategory(state) {
            return state.blogCategory
        },
        getAllBlogs(state) {
            return state.blog
        },
        getCategoryForProduct(state) {
            return state.categoryForProduct
        },
        getAllProducts(state) {
            return state.product
        },
        getNumberofProducts(state) {
            return state.numberofproducts
        },
        getSlider(state) {
            return state.sliders
        },
        getPoster(state) {
            return state.posters
        },
        getLogoForFrontend(state) {
            return state.logoForFrontend
        },
        getLoaderForBackend(state) {
            return state.LoaderForBackend
        },
        getShippingMethodsForBackend(state) {
            return state.ShippingMethodsForBackend
        },
        getPackagingForBackend(state) {
            return state.PackagingForBackend
        },
        getPickupLocationForBackend(state) {
            return state.PickupLocationForBackend
        },
        getWebsiteColorForBackend(state) {
            return state.WebsiteColorForBackend
        },
        getFooterForBackend(state) {
            return state.FooterForBackend
        },
        getPopupBannerForBackend(state) {
            return state.PopupBannerForBackend
        },
        getErrorBannerForBackend(state) {
            return state.ErrorBannerForBackend
        },
        getPendingOrders(state) {
            return state.pendingOrders
        },
        getProcessingOrders(state) {
            return state.processingOrders
        },
        getCompleteOrders(state) {
            return state.completeOrders
        },
        getDeclinedOrders(state) {
            return state.declinedOrders
        },
        getAllAboutForBackend(state) {
            return state.aboutForbackend
        },

        gettotalOrderforDashboard(state) {
            return state.gettotalOrderforBackend
        },
        gettotalNumberofSentSms(state) {
            return state.gettotalgetNumberofSentSms
        },
        gettotalNumberofRemainSms(state) {
            return state.gettotalgetNumberofRemainSms
        },
        gettotalAmountforDashboard(state) {
            return state.gettotalAmountforBackend
        },
        getCustomersforDashboard(state) {
            return state.gettotalCustomersforBackend
        },
        getProductsforDashboard(state) {
            return state.gettotalProductsforBackend
        },
        getstuffForBackend(state) {
            return state.stuffForBackend
        },
        getCustomerForBackend(state) {
            return state.CustomerForBackend
        },
        getUserRoleForBackend(state) {
            return state.UserRoleForBackend
        },
        // fronend
        getAllProductsForFrontend(state) {
            return state.frontendProdcts
        },
        getAllProductsForFrontendDeals(state) {
            return state.frontendDealsProdcts
        },
        getAllProductsForFrontendFeatured(state) {
            return state.frontendFeaturedProdcts
        },
        getAllProductsForFrontendTrending(state) {
            return state.frontendTrendingProdcts
        },
        getAllProductsForFrontendNew(state) {
            return state.frontendNewProdcts
        },
        getAllProductsForFrontendTop(state) {
            return state.frontendTopProdcts
        },
        getAllProductsForFrontendSale(state) {
            return state.frontendSaleProdcts
        },
        getAllBlogsForFrontend(state) {
            return state.frontendBlogs
        },
        getProductDetails(state) {
            return state.singleProductDetails
        },
        getTotalCartAmount(state) {
            return state.cartAmountForFrontend
        },
        getTotalCartQty(state) {
            return state.cartQtyForFrontend
        },
        getTotalCartInfo(state) {
            return state.cartInfoForFrontend
        },
        
    },
    actions: {
        allCategory(context, url) {
            axios.get(url)
                .then((response) => {
                    context.commit('categories', response.data.categories.data)
                })
        },
        allSms(context, url) {
            axios.get(url)
                .then((response) => {
                    context.commit('messages', response.data.messages.data)
                })
        },
         allHomeCategory(context, url) {
            axios.get(url)
                .then((response) => {
                    context.commit('homecategories', response.data.homecategories.data)
                })
        },
         allHomeCategoryProduct(context, url) {
            axios.get(url)
                .then((response) => {
                    context.commit('homecategoriesProducts', response.data.homecategoriesProducts.data)
                })
        },
        allSubCategory(context) {
            axios.get('get/subcategory/backend')
                .then((response) => {
                    context.commit('subCategories', response.data.subcategories)
                })
        },
        allChildCategory(context) {
            axios.get('get/childcategory/backend')
                .then((response) => {
                    context.commit('childCategories', response.data.childcategories)
                })
        },
        allCoupons(context) {
            axios.get('get/coupon/backend')
                .then((response) => {
                    context.commit('coupons', response.data.coupons)
                })
        },
        allPayments(context) {
            axios.get('get/payment/backend')
                .then((response) => {
                    context.commit('payments', response.data.payments)
                })
        },
        allBlogCategory(context) {
            axios.get('get/blog/category/backend')
                .then((response) => {
                    context.commit('blogCategories', response.data.blogCategories)
                })
        },
        allCategoryForNewProduct(context) {
            axios.get('/get/category/for/new/product')
                .then((response) => {
                    context.commit('allproductsForCategory', response.data.categories)
                })
        },
        getAllBlog(context, url) {
            axios.get(url)
                .then((response) => {
                    context.commit('allBlogs', response.data.blogs.data)
                })
        },
        getAllProduct(context, url) {
            axios.get(url)
                .then((response) => {
                    context.commit('allproducts', response.data.products.data)
                    context.commit('numberOfProducts', response.data.numberofproducts)
                })
        },
        SearchProduct(context, payload) {
            axios.get('/search?s=' + payload)
                .then((response) => {
                    context.commit('allproducts', response.data.products.data)
                    context.commit('numberOfProducts', response.data.numberofproducts)
                })
        },
        getAllProductWithStockDashboard(context, url) {
            axios.get(url)
                .then((response) => {
                    context.commit('allproducts', response.data.products.data)
                    context.commit('numberOfProducts', response.data.numberofproducts)
                })
        },
        allSliders(context) {
            axios.get('/get/slider/for/backend')
                .then((response) => {
                    context.commit('allSlidersForBackend', response.data.sliders)
                })
        },
        allPosters(context) {
            axios.get('/get/poster/for/backend')
                .then((response) => {
                    context.commit('allPostersForBackend', response.data.posters)
                })
        },
        allLogos(context) {
            axios.get('/get/logos/for/backend')
                .then((response) => {
                    context.commit('alLogosForBackend', response.data.logos)
                })
        },
        allLoaders(context) {
            axios.get('/get/loader/for/backend')
                .then((response) => {
                    context.commit('allLoadersForBackend', response.data.loader)
                })
        },
        allShippingMethods(context) {
            axios.get('/get/shipping/methods/for/backend')
                .then((response) => {
                    context.commit('allShippingMethodsForBackend', response.data.shipping_methods)
                })
        },
        allPackaging(context) {
            axios.get('/get/packaging/for/backend')
                .then((response) => {
                    context.commit('allPackagingForBackend', response.data.packaging)
                })
        },
        allPickupLocation(context, url) {
            axios.get(url)
                .then((response) => {
                    context.commit('allPickupLocationForBackend', response.data.pickup_location.data)
                })
        },
        allWebsiteColors(context) {
            axios.get('/get/website/color/for/backend')
                .then((response) => {
                    context.commit('allWebsiteColorForBackend', response.data.website_color)
                })
        },
        allFooter(context) {
            axios.get('/get/footer/for/backend')
                .then((response) => {
                    context.commit('allFooterForBackend', response.data.footer)
                })
        },
        allPopupBanners(context) {
            axios.get('/get/popup/banner/for/backend')
                .then((response) => {
                    context.commit('allPopupBannerForBackend', response.data.popup_banner)
                })
        },
        allErrorBanner(context) {
            axios.get('/get/error/banner/for/backend')
                .then((response) => {
                    context.commit('allErrorBannerForBackend', response.data.error_banner)
                })
        },
        allPendingOrders(context, url) {
            axios.get(url)
                .then((response) => {
                    context.commit('alPendingOrdersForBackend', response.data.pendingOrders.data)
                })
        },
        allProcessingOrders(context) {
            axios.get('/get/processing/orders/for/backend')
                .then((response) => {
                    context.commit('allProcessingOrdersForBackend', response.data.processingOrders)
                })
        },
        allCompletedOrders(context) {
            axios.get('/get/completed/orders/for/backend')
                .then((response) => {
                    context.commit('allCompletedOrdersForBackend', response.data.completeOrders)
                })
        },
        allDeclinedOrders(context) {
            axios.get('/get/declined/orders/for/backend')
                .then((response) => {
                    context.commit('allDeclinedOrdersForBackend', response.data.declinedOrders)
                })
        },

        allAbouts(context) {
            axios.get('/get/about/for/backend')
                .then((response) => {
                    context.commit('alAboutForBackend', response.data.about)
                })
        },


        totalOrdersForDashboard(context) {
            axios.get('/get/total/orders/for/dashboard')
                .then((response) => {
                    context.commit('getOrdersForDashboard', response.data.totalOrders)
                })
        },
        totalSentSmsDashboard(context) {
            axios.get('/get/total/sms/for/dashboard')
                .then((response) => {
                    context.commit('getNumberofSentSms', response.data.totalSms)
                })
        },
        totalRemainSmsDashboard(context) {
            axios.get('/get/smsreamin/dashboard')
                .then((response) => {
                    context.commit('getNumberofRemainSms', response.data.totalRemainSms)
                })
        },
        totalAmountsForDashboard(context) {
            axios.get('/get/total/amount/for/dashboard')
                .then((response) => {
                    context.commit('getAmountForDashboard', response.data.totalAmount)
                })
        },
        totalCustomerForDashboard(context) {
            axios.get('/get/total/customer/for/dashboard')
                .then((response) => {
                    context.commit('getCustomerForDashboard', response.data.totalCustomers)
                })
        },
        totalProductsrForDashboard(context) {
            axios.get('/get/total/products/for/dashboard')
                .then((response) => {
                    context.commit('getProductsForDashboard', response.data.totalProducts)
                })
        },

        allStuffs(context) {
            axios.get('/get/stuff/list/for/backend')
                .then((response) => {
                    context.commit('allStuffForBackend', response.data.stuff)
                })
        },

        allCustomerList(context, url) {
            axios.get(url)
                .then((response) => {
                    context.commit('allCustomerListForBackend', response.data.customers.data)
                })
        },

        checkForUserRole(context) {
            axios.get('check/user/role/for/backend')
                .then((response) => {
                    context.commit('checkUserRoleForBackend', response.data.role)
                })
        },

        // frontend
        frontendProducts(context) {
            axios.get('get/products/for/frontend')
                .then((response) => {
                    context.commit('allProductsForFrontend', response.data.products)
                })
        },
        frontendDealsProducts(context) {
            axios.get('get/deals/products/for/frontend')
                .then((response) => {
                    context.commit('allProductsForDealsFrontend', response.data.products)
                })
        },
        frontendFeaturedProducts(context) {
            axios.get('get/featured/products/for/frontend')
                .then((response) => {
                    context.commit('allProductsForFeaturedFrontend', response.data.products)
                })
        },
        frontendTrendingProducts(context) {
            axios.get('get/trending/products/for/frontend')
                .then((response) => {
                    context.commit('allProductsForTrendingFrontend', response.data.products)
                })
        },
        frontendNewProducts(context) {
            axios.get('get/new/products/for/frontend')
                .then((response) => {
                    context.commit('allProductsForNewFrontend', response.data.products)
                })
        },
        frontendTopProducts(context) {
            axios.get('get/top/products/for/frontend')
                .then((response) => {
                    context.commit('allProductsForTopFrontend', response.data.products)
                })
        },
        frontendSaleProducts(context) {
            axios.get('get/sale/products/for/frontend')
                .then((response) => {
                    context.commit('allProductsForSaleFrontend', response.data.products)
                })
        },
        frontendAllBlogs(context) {
            axios.get('get/blogs/for/frontend')
                .then((response) => {
                    context.commit('allBlogsForFrontend', response.data.blogs)
                })
        },
        getProductDetailsBySlug(context, payload) {
            axios.get('get/product/details/frontend/' + payload)
                .then((response) => {
                    context.commit('productDetailsForFrontend', response.data.product)
                })
        },
        totalCartAmount(context) {
            axios.get('get/cart/total/amount/frontend/')
                .then((response) => {
                    context.commit('cartAmountForFrontend', response.data.amount)
                })
        },
        totalCartQty(context) {
            axios.get('get/cart/total/qty/frontend/')
                .then((response) => {
                    context.commit('cartQtyForFrontend', response.data.qty)
                })
        },
        totalCartInfo(context) {
            axios.get('get/cart/total/info/frontend/')
                .then((response) => {
                    context.commit('cartInfoForFrontend', response.data.info)
                })
        }

    },
    mutations: {
        categories(state, data) {
            return state.category = data 
        },
        messages(state, data) {
            return state.message = data 
        },
        homecategories(state, data) {
            return state.homecategory = data
        },
        homecategoriesProducts(state, data) {
            return state.homecategoryproduct = data
        },
        subCategories(state, data) {
            return state.subcategory = data
        },
        childCategories(state, data) {
            return state.childcategory = data
        },
        coupons(state, data) {
            return state.coupon = data
        },
        payments(state, data) {
            return state.payment = data
        },
        blogCategories(state, data) {
            return state.blogCategory = data
        },
        allBlogs(state, data) {
            return state.blog = data
        },
        allproducts(state, data) {
            return state.product = data
        },
        numberOfProducts(state, data) {
            return state.numberofproducts = data
        },
        numberofSentSms(state, data) {
            return state.numberofsentsms = data
        },
        allproductsForCategory(state, data) {
            return state.categoryForProduct = data
        },
        allSlidersForBackend(state, data) {
            return state.sliders = data
        },
        allPostersForBackend(state, data) {
            return state.posters = data
        },
        alLogosForBackend(state, data) {
            return state.logoForFrontend = data
        },
        allLoadersForBackend(state, data) {
            return state.LoaderForBackend = data
        },
        allShippingMethodsForBackend(state, data) {
            return state.ShippingMethodsForBackend = data
        },
        allPackagingForBackend(state, data) {
            return state.PackagingForBackend = data
        },
        allPickupLocationForBackend(state, data) {
            return state.PickupLocationForBackend = data
        },
        allWebsiteColorForBackend(state, data) {
            return state.WebsiteColorForBackend = data
        },
        allFooterForBackend(state, data) {
            return state.FooterForBackend = data
        },
        allPopupBannerForBackend(state, data) {
            return state.PopupBannerForBackend = data
        },
        allErrorBannerForBackend(state, data) {
            return state.ErrorBannerForBackend = data
        },
        alPendingOrdersForBackend(state, data) {
            return state.pendingOrders = data
        },
        allProcessingOrdersForBackend(state, data) {
            return state.processingOrders = data
        },
        allCompletedOrdersForBackend(state, data) {
            return state.completeOrders = data
        },
        allDeclinedOrdersForBackend(state, data) {
            return state.declinedOrders = data
        },
        alAboutForBackend(state, data) {
            return state.aboutForbackend = data
        },


        getOrdersForDashboard(state, data) {
            return state.gettotalOrderforBackend = data
        },
        getNumberofSentSms(state, data) {
            return state.gettotalgetNumberofSentSms = data
        },
        getNumberofRemainSms(state, data) {
            return state.gettotalgetNumberofRemainSms = data
        },
        getAmountForDashboard(state, data) {
            return state.gettotalAmountforBackend = data
        },
        getCustomerForDashboard(state, data) {
            return state.gettotalCustomersforBackend = data
        },
        getProductsForDashboard(state, data) {
            return state.gettotalProductsforBackend = data
        },

        allStuffForBackend(state, data) {
            return state.stuffForBackend = data
        },
        allCustomerListForBackend(state, data) {
            return state.CustomerForBackend = data
        },
        checkUserRoleForBackend(state, data) {
            return state.UserRoleForBackend = data
        },
        // frontend
        allProductsForFrontend(state, data) {
            return state.frontendProdcts = data
        },
        allProductsForDealsFrontend(state, data) {
            return state.frontendDealsProdcts = data
        },
        allProductsForFeaturedFrontend(state, data) {
            return state.frontendFeaturedProdcts = data
        },
        allProductsForTrendingFrontend(state, data) {
            return state.frontendTrendingProdcts = data
        },
        allProductsForNewFrontend(state, data) {
            return state.frontendNewProdcts = data
        },
        allProductsForTopFrontend(state, data) {
            return state.frontendTopProdcts = data
        },
        allProductsForSaleFrontend(state, data) {
            return state.frontendSaleProdcts = data
        },
        allBlogsForFrontend(state, data) {
            return state.frontendBlogs = data
        },
        productDetailsForFrontend(state, data) {
            return state.singleProductDetails = data
        },
        cartAmountForFrontend(state, data) {
            return state.cartAmountForFrontend = data
        },
        cartQtyForFrontend(state, data) {
            return state.cartQtyForFrontend = data
        },
        cartInfoForFrontend(state, data) {
            return state.cartInfoForFrontend = data
        }
    }
}
