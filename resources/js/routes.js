import AdminHomeComponent from './components/admin/AdminHome.vue';

// backend components for category
import CategoryList from './components/admin/category/List.vue';
import AddCategory from './components/admin/category/New.vue';
import EditCategory from './components/admin/category/Edit.vue';

// backend components for homecategory
import HomeCategoryList from './components/admin/homecategory/List.vue';
import HomeAddCategory from './components/admin/homecategory/New.vue';
import HomeEditCategory from './components/admin/homecategory/Edit.vue';

// backend component for subcategory
import SubCategoryList from './components/admin/subcategory/List.vue';
import AddSubCategory from './components/admin/subcategory/New.vue';
import EditSubCategory from './components/admin/subcategory/Edit.vue';

// backend component for childcategory
import ChildCategoryList from './components/admin/childcategory/List.vue';
import AddChildCategory from './components/admin/childcategory/New.vue';
import EditChildCategory from './components/admin/childcategory/Edit.vue';

// backend components for post
import PostList from './components/admin/product/List.vue';
import AddPost from './components/admin/product/New.vue';
import EditPost from './components/admin/product/Edit.vue';
import HomeCategory from './components/admin/product/HomeCategory.vue';
import HomeCategoryProductAdd from './components/admin/product/HomeCategoryProductAdd.vue';

// backend components for coupon
import CouponList from './components/admin/coupon/List.vue';
import CouponPost from './components/admin/coupon/New.vue';
import EditCoupon from './components/admin/coupon/Edit.vue';

// backend components for blogCategory
import BlogCategoryList from './components/admin/blogCategory/List.vue';
import BlogCategoryPost from './components/admin/blogCategory/New.vue';
import EditBlogCategory from './components/admin/blogCategory/Edit.vue';

// backend components for blog
import BlogList from './components/admin/blog/List.vue';
import BlogPost from './components/admin/blog/New.vue';
import EditBlog from './components/admin/blog/Edit.vue';

// backend components for Payment
import PaymentList from './components/admin/payment/List.vue';
import PaymentPost from './components/admin/payment/New.vue';
import EditPayment from './components/admin/payment/Edit.vue';

// backend components for slider
import SliderList from './components/admin/slider/List.vue';
import SliderPost from './components/admin/slider/New.vue';
import EditSlider from './components/admin/slider/Edit.vue';

// backend components for poster
import PosterList from './components/admin/poster/List.vue';
import PosterPost from './components/admin/poster/New.vue';
import EditPoster from './components/admin/poster/Edit.vue';

// backend components for logo
import LogoList from './components/admin/logo/List.vue';
import LogoPost from './components/admin/logo/New.vue';
import EditLogo from './components/admin/logo/Edit.vue';

// backend components for Loader
import LoaderList from './components/admin/loader/List.vue';
import LoaderPost from './components/admin/loader/New.vue';
import EditLoader from './components/admin/loader/Edit.vue';

// backend components for shipping methods
import ShippingMethodList from './components/admin/shipping_method/List.vue';
import ShippingMethodPost from './components/admin/shipping_method/New.vue';
import EditShippingMethod from './components/admin/shipping_method/Edit.vue';

// backend components for Packaging
import PackagingList from './components/admin/packaging/List.vue';
import PackagingPost from './components/admin/packaging/New.vue';
import EditPackaging from './components/admin/packaging/Edit.vue';

// backend components for Pickup Location
import PickupList from './components/admin/pickup_location/List.vue';
import PickupPost from './components/admin/pickup_location/New.vue';
import EditPickup from './components/admin/pickup_location/Edit.vue';

// backend components for website color
import WebsiteColorList from './components/admin/website_color/List.vue';
import WebsiteColorPost from './components/admin/website_color/New.vue';
import EditWebsiteColor from './components/admin/website_color/Edit.vue';

// backend components for Footer
import FooterList from './components/admin/footer/List.vue';
import FooterPost from './components/admin/footer/New.vue';
import EditFooter from './components/admin/footer/Edit.vue';

// backend components for Popup Banner
import PopupList from './components/admin/popup_banner/List.vue';
import PopupPost from './components/admin/popup_banner/New.vue';
import EditPopup from './components/admin/popup_banner/Edit.vue';

// backend components for Error Banner
import ErrorList from './components/admin/error_banner/List.vue';
import ErrorPost from './components/admin/error_banner/New.vue';
import EditError from './components/admin/error_banner/Edit.vue';

// backend component for order
import PendingList from './components/admin/order/pendingList.vue';
import ProcessingList from './components/admin/order/processingList.vue';
import CompleteList from './components/admin/order/completeList.vue';
import DeclinedList from './components/admin/order/declinedList.vue';
import ViewOrder from './components/admin/order/viewOrder.vue';

// backend components for Stuff Management
import StuffList from './components/admin/stuff/List.vue';
import StuffPost from './components/admin/stuff/New.vue';
import EditStuff from './components/admin/stuff/Edit.vue';

// backend components for Customer
import CustomerList from './components/admin/customer/List.vue';
import CustomerPost from './components/admin/customer/New.vue';
import EditCustomer from './components/admin/customer/Edit.vue';

// backend components for Change Password
import ChangePassword from './components/admin/change_password.vue';

// backend components for About Us
import AboutList from './components/admin/about/List.vue';
import AboutPost from './components/admin/about/New.vue';
import EditAbout from './components/admin/about/Edit.vue';

import SmsList from './components/admin/sms/List.vue';
import SendSms from './components/admin/sms/New.vue';

export const routes = [
    { path: '/home', component: AdminHomeComponent },

    //path for category
    { path: '/category-list', component: CategoryList },
    { path: '/add-category', component: AddCategory },
    { path: '/edit-category/:categoryId', component: EditCategory },

    //path for category
    { path: '/home-category-list', component: HomeCategoryList },
    { path: '/home-add-category', component: HomeAddCategory },
    { path: '/home-edit-category/:categoryId', component: HomeEditCategory },


    //path for subcategory
    { path: '/subcategory-list', component: SubCategoryList },
    { path: '/add-subcategory', component: AddSubCategory },
    { path: '/edit-subcategory/:subCategoryId', component: EditSubCategory },

    //path for childcategory
    { path: '/childcategory-list', component: ChildCategoryList },
    { path: '/add-childcategory', component: AddChildCategory },
    { path: '/edit-childcategory/:childCategoryId', component: EditChildCategory },

    //path for post
    { path: '/product-list', component: PostList },
    { path: '/add-product', component: AddPost },
    { path: '/edit-product/:productId', component: EditPost },
    { path: '/add-home-category-product', component: HomeCategory },
    { path: '/add-products/:slug', component: HomeCategoryProductAdd },

    //path for coupon
    { path: '/coupon-list', component: CouponList },
    { path: '/add-coupon', component: CouponPost },
    { path: '/edit-coupon/:couponId', component: EditCoupon },

    //path for blogCategory
    { path: '/blogCategory-list', component: BlogCategoryList },
    { path: '/add-blogCategory', component: BlogCategoryPost },
    { path: '/edit-blogCategory/:blogCategoryId', component: EditBlogCategory },

    //path for blog
    { path: '/blog-list', component: BlogList },
    { path: '/add-blog', component: BlogPost },
    { path: '/edit-blog/:blogId', component: EditBlog },

    //path for payment
    { path: '/payment-list', component: PaymentList },
    { path: '/add-payment', component: PaymentPost },
    { path: '/edit-payment/:paymentId', component: EditPayment },

    //path for slider
    { path: '/slider-list', component: SliderList },
    { path: '/add-slider', component: SliderPost },
    { path: '/edit-slider/:sliderId', component: EditSlider },

    //path for poster
    { path: '/poster-list', component: PosterList },
    { path: '/add-poster', component: PosterPost },
    { path: '/edit-poster/:posterId', component: EditPoster },

    //path for logo
    { path: '/logo-list', component: LogoList },
    { path: '/add-logo', component: LogoPost },
    { path: '/edit-logo/:logoId', component: EditLogo },


    //path for loader
    { path: '/loader-list', component: LoaderList },
    { path: '/add-loader', component: LoaderPost },
    { path: '/edit-loader/:loaderId', component: EditLoader },

    //path for shipping methods
    { path: '/shippingMethod-list', component: ShippingMethodList },
    { path: '/add-shippingMethod', component: ShippingMethodPost },
    { path: '/edit-shippingMethod/:shippingMethodId', component: EditShippingMethod },

    //path for packaging
    { path: '/packaging-list', component: PackagingList },
    { path: '/add-packaging', component: PackagingPost },
    { path: '/edit-packaging/:packagingId', component: EditPackaging },

    //path for pickup
    { path: '/pickup-list', component: PickupList },
    { path: '/add-pickup', component: PickupPost },
    { path: '/edit-pickup/:pickupId', component: EditPickup },

    //path for website color
    { path: '/websiteColor-list', component: WebsiteColorList },
    { path: '/add-websiteColor', component: WebsiteColorPost },
    { path: '/edit-websiteColor/:websiteColorId', component: EditWebsiteColor },

    //path for Footer
    { path: '/footer-list', component: FooterList },
    { path: '/add-footer', component: FooterPost },
    { path: '/edit-footer/:footerId', component: EditFooter },

    //path for Popup Banner
    { path: '/popup-list', component: PopupList },
    { path: '/add-popup', component: PopupPost },
    { path: '/edit-popup/:popupId', component: EditPopup },

    //path for Error Banner
    { path: '/error-list', component: ErrorList },
    { path: '/add-error', component: ErrorPost },
    { path: '/edit-error/:errorId', component: EditError },

    //path for order
    { path: '/pending-list', component: PendingList },
    { path: '/processing-list', component: ProcessingList },
    { path: '/complete-list', component: CompleteList },
    { path: '/declined-list', component: DeclinedList },
    { path: '/view-order/:orderId', component: ViewOrder },

    //path for About
    { path: '/about-list', component: AboutList },
    { path: '/add-about', component: AboutPost },
    { path: '/edit-about/:aboutId', component: EditAbout },

    //path for Stuff Management
    { path: '/stuff-list', component: StuffList },
    { path: '/add-stuff', component: StuffPost },
    { path: '/edit-stuff/:stuffId', component: EditStuff },

    //path for Customer
    { path: '/customer-list', component: CustomerList },
    { path: '/add-customer', component: CustomerPost },
    { path: '/edit-customer/:customerId', component: EditCustomer },

    //path for change password
    { path: '/change-password', component: ChangePassword },

    //path for Customer
    { path: '/sms-list', component: SmsList },
    { path: '/send-sms', component: SendSms },

]