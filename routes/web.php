<?php
use Spatie\Honeypot\ProtectAgainstSpam;

Route::get('/', function () {
    return view('auth/login');
});

Route::fallback(function () {
    return redirect("/login");
});

Route::middleware(ProtectAgainstSpam::class)->group(function() {
    Auth::routes();
});
// Route::get('/{anypath}','FrontendController@index')->where('path','.*');

Route::group(['middleware' => 'auth'],function(){

    Route::get('/home', 'HomeController@index')->name('home');
    // Route::get('/{anypath}','HomeController@index')->where('path','.*');
    // Route::get('/{anypath}/{id}','HomeController@index')->where('path','.*');

    // category
    Route::post('/add/new/category','CategoryController@addNewCategory');
    Route::get('/get/category/backend','CategoryController@viewAllCategory');
    Route::get('/delete/category/{id}','CategoryController@deleteCategory');
    Route::get('/edit/category/{id}','CategoryController@editCategory');
    Route::post('/update/category/name/{id}','CategoryController@updateCategory');
    Route::get('/get/category/for/new/product','CategoryController@getCategoryForProduct');

    // homecategory
    Route::post('/add/new/home/category','HomeCategoryController@addNewCategory');
    Route::get('/get/homecategory/backend','HomeCategoryController@viewAllCategory');
    Route::get('/delete/homecategory/{id}','HomeCategoryController@deleteCategory');
    Route::get('/edit/homecategory/{id}','HomeCategoryController@editCategory');
    Route::post('/update/home/category/name/{id}','HomeCategoryController@updateCategory');
    Route::get('/home/category/product/search/{id}','HomeCategoryController@productSearch');
    Route::post('/add/home/category/product','HomeCategoryController@addHomeCategoryProduct');
    Route::get('/get/homecateprory/product/{slug}','HomeCategoryController@getHomeCategoryProduct');
    Route::get('/home/category/detail/{slug}','HomeCategoryController@homeCategoryDetail');
    Route::get('/delete/home/category/product/{id}','HomeCategoryController@deleteHomeCategoryProduct');


    //subcategory
    Route::get('get/subcategory/backend','SubCategoryController@viewAllSubCategory');
    Route::post('/add/new/subcategory','SubCategoryController@addNewSubCategory');
    Route::get('/delete/subcategory/{id}','SubCategoryController@deleteSubCategory');
    Route::get('/edit/subcategory/details/{id}','SubCategoryController@editSubCategory');
    Route::post('/update/subcategory/{id}','SubCategoryController@updateSubCategory');

    //childcategory
    Route::get('get/childcategory/backend','ChildCategoryController@viewAllChildCategory');
    Route::get('/get/subcategory/list/{id}','ChildCategoryController@getSubCategoryByCategory');
    Route::get('/edit-product/get/subcategory/list/{id}','ChildCategoryController@getSubCategoryByCategoryEditProduct');
    Route::get('/edit-childcategory/get/subcategory/backend','ChildCategoryController@viewAllSubCategory');
    Route::get('/edit-childcategory/get/subcategory/list/{id}','ChildCategoryController@getSubCategoryByCategory');
    Route::post('/add/new/childcategory','ChildCategoryController@addNewChildCategory');
    Route::get('/delete/childcategory/{id}','ChildCategoryController@deleteChildCategory');
    Route::get('/edit/childcategory/details/{id}','ChildCategoryController@editChildCategory');
    Route::get('get/subcategory/by/category/{id}','ChildCategoryController@getsubByCategory');
    Route::post('/update/childcategory/{id}','ChildCategoryController@updateChildCategory');

    // product
    Route::get('/get/product/backend','ProductController@viewAllProduct');
    Route::post('/add/new/product','ProductController@addNewProduct');
    Route::get('/delete/product/{id}','ProductController@deleteProduct');
    Route::get('/edit/product/details/{id}','ProductController@editProduct');
    Route::post('/update/product/{id}','ProductController@updateproduct');
    Route::get('get/childcategory/list/{id}','ProductController@getChildBySubCategory');
    Route::get('/edit-product/get/childcategory/list/{id}','ProductController@getChildBySubCategoryEditProduct');
    Route::get('/product/status/change/{id}','ProductController@statusChange');
    Route::post('/multiple/image','ProductController@multipleImageUpload');
    Route::get('/get/product/stock/for/dashboard','ProductController@productsForDashboard');
    Route::get('/search','ProductController@searchProductBackend');
    Route::get('get/all/products', 'ProductController@getAllProducts');

    // coupon
    Route::post('/add/new/coupon','CouponController@addNewCoupon');
    Route::get('/get/coupon/backend','CouponController@getCoupon');
    Route::get('/delete/coupon/{id}','CouponController@deleteCoupon');
    Route::get('/edit/coupon/details/{id}','CouponController@editCoupon');
    Route::post('/update/coupon/{id}','CouponController@updateCoupon');

    // Blog
    Route::get('/get/blog/category/backend','BlogController@getBlogCategoryBackend');
    Route::get('/edit-blog/get/blog/category/backend','BlogController@getBlogCategoryBackend');
    Route::post('/add/new/blog/category','BlogController@addNewBlogCategory');
    Route::get('/delete/blog/category/{id}','BlogController@deleteBlogCategory');
    Route::get('/edit/blog/category/details/{id}','BlogController@editBlogCategory');
    Route::post('/update/blog/category/{id}','BlogController@updateBlogCategory');
    Route::post('/add/new/blog','BlogController@addNewBlog');
    Route::get('/get/blog/backend','BlogController@viewAllBlog');
    Route::get('/delete/blog/{id}','BlogController@deleteBlog');
    Route::get('/edit/blog/details/{id}','BlogController@editBlogData');
    Route::post('/update/blog/{id}','BlogController@updateBlog');

    // Payment
    Route::post('/add/new/payment','PaymentController@addNewPayment');
    Route::get('/get/payment/backend','PaymentController@getPaymentBackend');
    Route::get('/delete/payment/{id}','PaymentController@deletePayment');
    Route::get('/payment/status/change/{id}','PaymentController@statusChange');
    Route::get('/edit/payment/details/{id}','PaymentController@editPayment');
    Route::post('/update/payment/{id}','PaymentController@updatePayment');

    // Slider
    Route::post('/add/new/slider','SliderController@addNewSlider');
    Route::get('/get/slider/for/backend','SliderController@getAllSlider');
    Route::get('/delete/slider/{id}','SliderController@deleteSlider');
    Route::get('/edit/slider/{id}','SliderController@editSlider');
    Route::post('/update/slider/{id}','SliderController@updateSlider');

    // Poster
    Route::post('/add/new/poster','PosterController@addNewPoster');
    Route::get('/get/poster/for/backend','PosterController@getPostersForbackend');
    Route::get('/delete/poster/{id}','PosterController@deletePoster');
    Route::get('/edit/poster/{id}','PosterController@editPoster');
    Route::post('/update/poster/{id}','PosterController@updatePoster');

    //Logo
    Route::post('/add/new/logo','LogoController@addNewLogo');
    Route::get('/get/logos/for/backend','LogoController@getLogoForBackend');
    Route::get('/delete/logo/{id}','LogoController@deleteLogo');
    Route::get('/edit/logo/details/{id}','LogoController@editLogoData');
    Route::post('/update/logo/{id}','LogoController@updateLogo');

    // Loader
    Route::get('/get/loader/for/backend','LoaderController@getLoaderForBackend');
    Route::post('/add/new/loader','LoaderController@addNewLoader');
    Route::get('/delete/loader/{id}','LoaderController@deleteLoader');
    Route::get('/loader/status/change/{id}','LoaderController@loderStatusChange');
    Route::get('/edit/loader/details/{id}','LoaderController@editLoader');
    Route::post('/update/loader/{id}','LoaderController@updateLoader');

    // Shipping Methods
    Route::get('/get/shipping/methods/for/backend','ShippingMethodController@getShippingMethodsForBackend');
    Route::post('/add/new/shipping/method','ShippingMethodController@addNewShippingMethod');
    Route::get('/delete/shipping/method/{id}','ShippingMethodController@deleteShippingMethod');
    Route::get('/edit/shipping/method/{id}','ShippingMethodController@editShippingMethod');
    Route::post('/update/shipping/method/{id}','ShippingMethodController@updateShippingMethod');

    // packaging
    Route::get('/get/packaging/for/backend','PackagingController@getPackagingData');
    Route::post('/add/new/packaging','PackagingController@addNewPackaging');
    Route::get('/delete/packaging/{id}','PackagingController@deletePackaging');
    Route::get('/edit/packaging/details/{id}','PackagingController@editPackaging');
    Route::post('/update/packaging/{id}','PackagingController@updatePackaging');

    // pickup location
    Route::get('/get/pickup/location/for/backend','PickupLocationController@getPickupLocation');
    Route::post('add/new/location','PickupLocationController@addNewPickupLocation');
    Route::get('/delete/pickup/{id}','PickupLocationController@deletePickupLocation');
    Route::get('/edit/location/details/{id}','PickupLocationController@editPickupLocation');
    Route::post('/update/location/{id}','PickupLocationController@updateLocation');

    // website color
    Route::get('/get/website/color/for/backend','WebsiteColorController@getWebsiteColorforBackend');
    Route::post('/add/new/website/color','WebsiteColorController@addNewWesbiteColor');
    Route::get('/delete/website/color/{id}','WebsiteColorController@deleteWebsiteColor');
    Route::get('/edit/website/color/details/{id}','WebsiteColorController@editWebsiteColorData');
    Route::post('/update/website/color/{id}','WebsiteColorController@updateWebsiteColor');

    // Footer
    Route::get('/get/footer/for/backend','FooterController@getFooterForBackend');
    Route::post('/add/new/footer','FooterController@addNewFooter');
    Route::get('/delete/footer/{id}','FooterController@deleteFooter');
    Route::get('/edit/footer/details/{id}','FooterController@editFooterDetails');
    Route::post('/update/footer/{id}','FooterController@updateFooter');

    // Popup Banner
    Route::get('/get/popup/banner/for/backend','PopupBannerController@getPopupBannerForBackend');
    Route::post('/add/new/popup/banner','PopupBannerController@addNewPopupBanner');
    Route::get('/delete/popup/banner/{id}','PopupBannerController@deletePopupBanner');
    Route::get('/popup/banner/status/change/{id}','PopupBannerController@statusChange');
    Route::get('/edit/popup/banner/details/{id}','PopupBannerController@editPopupBannerData');
    Route::post('/update/popup/banner/{id}','PopupBannerController@updatePopupBanner');

    // Error Banner
    Route::get('/get/error/banner/for/backend','ErrorBannerController@getErrorBanner');
    Route::post('/add/new/error/banner','ErrorBannerController@addNewErrorBanner');
    Route::get('/delete/error/banner/{id}','ErrorBannerController@deleteBanner');
    Route::get('/edit/error/banner/{id}','ErrorBannerController@editErrorBanner');
    Route::post('/update/error/banner/{id}','ErrorBannerController@updateErrorBanner');
    Route::get('/error/banner/status/change/{id}','ErrorBannerController@errorBannerStatus');

    // orders
    Route::get('/get/pending/orders/for/backend','OrderController@pendingOrders');
    Route::get('/get/processing/orders/for/backend','OrderController@processingOrder');
    Route::get('/get/completed/orders/for/backend','OrderController@completeOrders');
    Route::get('/get/declined/orders/for/backend','OrderController@declindedOrders');
    Route::get('/view/order/details/{id}','OrderController@viewOrderDetails');
    Route::get('/view/shipping/details/{id}','OrderController@viewShippingDetails');
    Route::get('/processing/order/{id}','OrderController@Orderprocess');
    Route::get('/complete/order/{id}','OrderController@orderComplete');
    Route::get('/order/decline/{id}','OrderController@orderDeclined');
    Route::get('/delete/order/{id}','OrderController@deleteOrder');
    Route::get('/shop/info/','OrderController@shopInfo');

    // print order
    Route::get('/print/order/details/{id}','OrderController@printOrder');
    Route::get('/calculate/sales/details/{id}','OrderController@calculateOrder');

    // Dashboard
    Route::get('/get/total/orders/for/dashboard','OrderController@getTotalOrdersForDashboard');
    Route::get('/get/total/amount/for/dashboard','OrderController@getTotalAmountForDashboard');
    Route::get('/get/total/customer/for/dashboard','OrderController@getTotalCustomerForDashboard');
    Route::get('/get/total/products/for/dashboard','OrderController@getTotalProductsForDashboard');
    Route::get('/get/total/sms/for/dashboard','HomeController@getTotalSmsForDashboard');
    Route::get('/get/smsreamin/dashboard','HomeController@getTotalRemainSmsForDashboard');

    //About
    Route::get('/get/about/for/backend','LogoController@getAboutForBackend');
    Route::post('/add/new/about','LogoController@addNewAbout');
    Route::get('/delete/about/{id}','LogoController@deleteAbout');
    Route::get('/edit/about/details/{id}','LogoController@editAboutData');
    Route::post('/update/about/{id}','LogoController@updateAbout');

    // Change Password
    Route::get('change/password/page','ChangePassowrdController@changePasswordPage');
    Route::post('/change/your/password','ChangePassowrdController@changeYourPassword');

    // stuff
    Route::get('/get/stuff/list/for/backend','StuffController@getStuffList');
    Route::post('/add/new/stuff','StuffController@addNewStuff');
    Route::get('/delete/stuff/{id}','StuffController@deleteStuff');
    Route::get('/edit/stuff/details/{id}','StuffController@editStuffDetails');
    Route::post('/update/stuff/{id}','StuffController@updateStuff');
    Route::get('check/user/role/for/backend','StuffController@checkUserRole');

    // customer
    Route::get('/get/customer/list/for/backend','CustomerController@getAllCustomerList');
    Route::get('/delete/customer/{id}','CustomerController@deleteCustomer');

    Route::get('/customer/dashboard','CustomerController@customerDashboard');
    Route::post('/change/your/password/customer','CustomerController@changePassword');
    Route::get('order/details/{slug}','CustomerController@orderDetails');

});

// frontend product
Route::get('/','FrontendController@index');
Route::get('about/us','FrontendController@aboutUs');
Route::get('product/details/{slug}','FrontendController@productDetails')->name('product.details');
Route::get('/shop','FrontendController@shop');
Route::get('/home/category/{slug}','FrontendController@HomeCategoryProducts')->name('home.categories.product');
Route::get('offer/products','FrontendController@offerProducts');
Route::get('/category/wise/products/{slug}','FrontendController@categoryWiseProducts');
Route::get('/subcategory/wise/products/{subcategory_slug}','FrontendController@subcategoryWiseProducts');
Route::get('/childcategory/wise/products/{slug}','FrontendController@childCategoryWiseProducts');
Route::post('search/product','FrontendController@searchProduct');
Route::post('/add/product/to/cart','CartController@addToCart');
Route::post('/add/product/to/buy', 'CartController@addToBuy');
Route::get('delete/cart/item/{id}','CartController@deleteCart');
Route::get('view/cart','CartController@viewCart');
Route::get('privacy/policy','FrontendController@aboutUs1');
Route::post('update/cart/qty','CartController@updateCartQuantity');
Route::get('/category/wise/products/{slug}','FrontendController@categoryWiseProducts')->name('categories.product');

// wishlist
Route::post('add/to/wish/list','CartController@addToWishList');
Route::get('view/wishlist','CartController@viewWishList');
Route::get('delete/wishlist/{id}','CartController@deleteWishList');

Route::get('checkout/page','CheckoutController@checkoutPage');
Route::post('checkout','CheckoutController@checkout');
Route::post('apply/coupon','FrontendController@applyCoupon');

Route::get('test/for/pictures','FrontendController@convertJsonToArray');

Route::get('/AllCustomers', 'HomeController@AllCustomers');

// Route::get('/AllSms', 'HomeController@AllSms'); 
Route::get('/sms', 'HomeController@sms'); 
Route::post('/sendsms', 'HomeController@sendsms');

Route::get('/get/sms/backend','HomeController@AllSms');
