<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['cors'])->group(function () {
    Route::group(['namespace' => 'Api'], function () {

    Route::get('get/all/products', 'ApiController@getAllProducts');

    Route::Post('user/login', 'ApiController@userLogin');
    Route::Post('user/register', 'ApiController@userRegistration');

    Route::get('get/sliders', 'ApiController@getSlider');
    Route::get('get/posters', 'ApiController@getPoster');

    Route::get('get/products', 'ApiController@getProducts');
    Route::get('get/category/list', 'ApiController@getCategoryList');
    Route::get('get/subcategory/list', 'ApiController@getSubCategoryList');
    Route::get('get/childcategory/list', 'ApiController@getChildCategoryList');

    Route::get('category/wise/products/{slug}', 'ApiController@categoryWiseProduct');
    Route::get('subcategory/wise/products/{slug}', 'ApiController@subcategoryWiseProduct');
    Route::get('childcategory/wise/products/{slug}', 'ApiController@childcategoryWiseProduct');
    
     Route::get('homeproduct/dealsmonth', 'ApiController@dealsmonth');
    Route::get('homeproduct/flashsale', 'ApiController@flashsale');
    Route::get('homeproduct/trending', 'ApiController@trending');
    Route::get('homeproduct/featureproduct', 'ApiController@featureproduct');
    Route::get('homeproduct/newarrival', 'ApiController@newarrival');
    Route::get('homeproduct/toprated', 'ApiController@toprated');
    Route::post('categorywise/homeproduct', 'ApiController@categorywisehomepageproduct');

    Route::get('get/cart/products/{random_number}', 'ApiController@getCartProducts');
    Route::post('add/products/to/cart', 'ApiController@addProductsToCart');
    Route::post('delete/products/to/cart', 'ApiController@deleteProductsToCart');
    Route::get('delete/cart/item/{id}', 'ApiController@deleteCartitem');

    Route::post('search/product', 'ApiController@searchProduct');
    Route::post('related/product', 'ApiController@relatedProduct');

    Route::post('subcategory/bycategoryid', 'ApiController@getSubCategoryListByCategoryID');

    Route::post('childcategory/bysubcategoryid', 'ApiController@getChildCategoryListBySubcategoryID');

    Route::get('offer/products', 'ApiController@offerProducts');
    Route::get('about/us', 'ApiController@aboutUs');
    Route::get('get/icon/logo/title', 'ApiController@getIconLogoTitle');
    Route::get('get/shipping/methods', 'ApiController@getShippingMethods');
    Route::get('get/packaging/lists', 'ApiController@getPackagingLists');

    Route::get('get/wishlist/products/{random_number}', 'ApiController@getWishListProduct');
    Route::post('add/product/to/wish/list', 'ApiController@addProductToWishList');
    Route::get('delete/product/from/wishlist/{id}', 'ApiController@deleteProductFromWishList');

    Route::post('apply/coupon', 'ApiController@applyCoupon');

    Route::post('checkout', 'ApiController@checkout');
    Route::get('get/my/orders/{id}', 'ApiController@getMyOrders');

    Route::get('get/my/order/details/{id}', 'ApiController@getMyOrderDetails');
    Route::get('product/search', 'ApiController@productSearch');

    Route::get('/AllSms', 'HomeController@AllSms'); 

});
    
});


