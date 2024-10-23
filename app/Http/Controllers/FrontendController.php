<?php

namespace App\Http\Controllers;
use App\About;
use App\Banner;
use App\Blog;
use App\Cart;
use App\Category;
use App\ChildCategory;
use App\Coupon;
use App\Footer;
use App\HomeCategory;
use App\HomeCategoryProduct;
use App\Icon;
use App\PopupBanner;
use App\Poster;
use App\Product;
use App\SubCategory;
use App\WishList;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FrontendController extends Controller
{
    public function index(){

        $home_categories = HomeCategory::get()->each(function($pro) {
            $pro->load('limit_products');
        });

        $icon = Icon::orderBy('id','desc')->first();
        $banners = Banner::orderBy('id','desc')->get();
        $categories = Category::all();
        $top_posters = Poster::where('position','top')->orderBy('id','desc')->first();
        $deals_month_products = Product::where('status', 1)->orderBy('id', 'desc')->limit(12)->get();
        $feature_products = Product::where('status', 1)->inRandomOrder()->limit(8)->get();
        $trending_products = Product::where('status', 1)->inRandomOrder()->limit(8)->get();
        $new_products = Product::where('status', 1)->inRandomOrder()->limit(8)->get();
        $top_sale_products = Product::where('status', 1)->inRandomOrder()->limit(8)->get();
        $sale_products = Product::where('status', 1)->inRandomOrder()->limit(8)->get();
        $blogs = Blog::orderBy('id','desc')->limit(5)->get();
        $about = About::orderBy('id','desc')->first();
        $footer = Footer::orderBy('id','desc')->first();

        $cart = DB::table('carts')
                    ->join('products','carts.product_id','=','products.id')
                    ->select('carts.*','products.name as product_name','products.image as product_image','products.slug as product_slug')
                    ->where('carts.random_number',session('random_number'))
                    ->orderBy('id','desc')
                    ->get();

        $cart_number = Cart::where('random_number',session('random_number'))->count();

        $wish_list = DB::table('wish_lists')
                    ->join('products','wish_lists.product_id','=','products.id')
                    ->select('wish_lists.*','products.name as product_name','products.image as product_image','products.slug as product_slug')
                    ->where('wish_lists.random_number',session('random_number'))
                    ->orderBy('id','desc')
                    ->get();
        $wish_list_number = WishList::where('random_number',session('random_number'))->count();

        $popup_banner = PopupBanner::orderBy('id','desc')->first();

        return view('auth/login',compact('popup_banner','wish_list','wish_list_number','icon','banners','categories','top_posters', 'sale_products','deals_month_products','feature_products','trending_products','new_products','top_sale_products','blogs','cart','cart_number','about','footer','home_categories'));
    }

    public function productDetails($slug){
        $icon = Icon::orderBy('id','desc')->first();
        $categories = Category::all();
        Product::where('slug',$slug)->increment('views',1);
        $details = Product::where('slug',$slug)->first();
        $products = Product::where('category_id',$details->category_id)->where('status',1)->limit(6)->get();
        $about = About::orderBy('id','desc')->first();

        $cart = DB::table('carts')
                ->join('products','carts.product_id','=','products.id')
                ->select('carts.*','products.name as product_name','products.image as product_image','products.slug as product_slug')
                ->where('carts.random_number',session('random_number'))
                ->orderBy('id','desc')
                ->get();
        $cart_number = Cart::where('random_number',session('random_number'))->count();
        $footer = Footer::orderBy('id','desc')->first();

        $wish_list = DB::table('wish_lists')
        ->join('products','wish_lists.product_id','=','products.id')
        ->select('wish_lists.*','products.name as product_name','products.image as product_image','products.slug as product_slug')
        ->where('wish_lists.random_number',session('random_number'))
        ->orderBy('id','desc')
        ->get();
        $wish_list_number = WishList::where('random_number',session('random_number'))->count();

        return view('public.product_details',compact('wish_list','wish_list_number','icon','categories','details','products','cart','cart_number','about','footer'));
    }

    public function shop(){

        $icon = Icon::orderBy('id','desc')->first();
        $categories = Category::all();
        $most_viewed_products = Product::where('status',1)->orderBy('views','desc')->limit(6)->get();
        $products = Product::orderBy('id','desc')->where('status',1)->paginate();
        $about = About::orderBy('id','desc')->first();
        $cart = DB::table('carts')
        ->join('products','carts.product_id','=','products.id')
        ->select('carts.*','products.name as product_name','products.image as product_image','products.slug as product_slug')
        ->where('carts.random_number',session('random_number'))
        ->orderBy('id','desc')
        ->get();
        $cart_number = Cart::where('random_number',session('random_number'))->count();
        $footer = Footer::orderBy('id','desc')->first();

        $wish_list = DB::table('wish_lists')
        ->join('products','wish_lists.product_id','=','products.id')
        ->select('wish_lists.*','products.name as product_name','products.image as product_image','products.slug as product_slug')
        ->where('wish_lists.random_number',session('random_number'))
        ->orderBy('id','desc')
        ->get();
        $wish_list_number = WishList::where('random_number',session('random_number'))->count();

        return view('public.shop',compact('wish_list','wish_list_number','icon','categories','most_viewed_products','products','cart','cart_number','about','footer'));
    }

    public function HomeCategoryProducts($slug){

        $home_category_id = HomeCategory::where('slug',$slug)->first()->id;



        $icon = Icon::orderBy('id','desc')->first();
        $categories = Category::all();
        $most_viewed_products = Product::orderBy('views','desc')->limit(3)->get();
        $home_categories_products = HomeCategoryProduct::where('home_category_id',$home_category_id)->orderBy('id','desc')->paginate(16);
        $about = About::orderBy('id','desc')->first();
        $cart = DB::table('carts')
        ->join('products','carts.product_id','=','products.id')
        ->select('carts.*','products.name as product_name','products.image as product_image','products.slug as product_slug')
        ->where('carts.random_number',session('random_number'))
        ->orderBy('id','desc')
        ->get();
        $cart_number = Cart::where('random_number',session('random_number'))->count();
        $footer = Footer::orderBy('id','desc')->first();

        $wish_list = DB::table('wish_lists')
        ->join('products','wish_lists.product_id','=','products.id')
        ->select('wish_lists.*','products.name as product_name','products.image as product_image','products.slug as product_slug')
        ->where('wish_lists.random_number',session('random_number'))
        ->orderBy('id','desc')
        ->get();
        $wish_list_number = WishList::where('random_number',session('random_number'))->count();

        return view('public.home_categories',compact('wish_list','wish_list_number','icon','categories','most_viewed_products','home_categories_products','cart','cart_number','about','footer'));

    }

    

   


 



    public function categoryWiseProducts($slug){
        $category = Category::where('slug',$slug)->first();
        $icon = Icon::orderBy('id','desc')->first();
        $categories = Category::all();
        $most_viewed_products = Product::orderBy('views','desc')->where('status',1)->limit(3)->get();
        $products = Product::orderBy('id','desc')->where('category_id',$category->id)->where('status',1)->paginate(16);
        $about = About::orderBy('id','desc')->first();
        $cart = DB::table('carts')
        ->join('products','carts.product_id','=','products.id')
        ->select('carts.*','products.name as product_name','products.image as product_image','products.slug as product_slug')
        ->where('carts.random_number',session('random_number'))
        ->orderBy('id','desc')
        ->get();
        $cart_number = Cart::where('random_number',session('random_number'))->count();
        $footer = Footer::orderBy('id','desc')->first();

        $wish_list = DB::table('wish_lists')
        ->join('products','wish_lists.product_id','=','products.id')
        ->select('wish_lists.*','products.name as product_name','products.image as product_image','products.slug as product_slug')
        ->where('wish_lists.random_number',session('random_number'))
        ->orderBy('id','desc')
        ->get();
        $wish_list_number = WishList::where('random_number',session('random_number'))->count();

        return view('public.shop',compact('wish_list','wish_list_number','icon','categories','most_viewed_products','products','cart','cart_number','about','footer'));
    }

    public function subcategoryWiseProducts($subcategory_slug){
        $sub_category = SubCategory::where('slug',$subcategory_slug)->first();
        $icon = Icon::orderBy('id','desc')->first();
        $categories = Category::all();
        $most_viewed_products = Product::orderBy('views','desc')->where('status',1)->limit(3)->get();
        $products = Product::orderBy('id','desc')->where('subcategory_id',$sub_category->id)->where('status',1)->paginate(16);
        $about = About::orderBy('id','desc')->first();
        $cart = DB::table('carts')
        ->join('products','carts.product_id','=','products.id')
        ->select('carts.*','products.name as product_name','products.image as product_image','products.slug as product_slug')
        ->where('carts.random_number',session('random_number'))
        ->orderBy('id','desc')
        ->get();
        $cart_number = Cart::where('random_number',session('random_number'))->count();
        $footer = Footer::orderBy('id','desc')->first();

        $wish_list = DB::table('wish_lists')
        ->join('products','wish_lists.product_id','=','products.id')
        ->select('wish_lists.*','products.name as product_name','products.image as product_image','products.slug as product_slug')
        ->where('wish_lists.random_number',session('random_number'))
        ->orderBy('id','desc')
        ->get();
        $wish_list_number = WishList::where('random_number',session('random_number'))->count();

        return view('public.shop',compact('wish_list','wish_list_number','icon','categories','most_viewed_products','products','cart','cart_number','about','footer'));
    }

    public function childCategoryWiseProducts($slug){
        $child_Category = ChildCategory::where('slug',$slug)->first();
        $icon = Icon::orderBy('id','desc')->first();
        $categories = Category::all();
        $most_viewed_products = Product::orderBy('views','desc')->where('status',1)->limit(3)->get();
        $products = Product::orderBy('id','desc')->where('childcategory_id',$child_Category->id)->where('status',1)->paginate(16);
        $about = About::orderBy('id','desc')->first();
        $cart = DB::table('carts')
        ->join('products','carts.product_id','=','products.id')
        ->select('carts.*','products.name as product_name','products.image as product_image','products.slug as product_slug')
        ->where('carts.random_number',session('random_number'))
        ->orderBy('id','desc')
        ->get();
        $cart_number = Cart::where('random_number',session('random_number'))->count();
        $footer = Footer::orderBy('id','desc')->first();

        $wish_list = DB::table('wish_lists')
        ->join('products','wish_lists.product_id','=','products.id')
        ->select('wish_lists.*','products.name as product_name','products.image as product_image','products.slug as product_slug')
        ->where('wish_lists.random_number',session('random_number'))
        ->orderBy('id','desc')
        ->get();
        $wish_list_number = WishList::where('random_number',session('random_number'))->count();

        return view('public.shop',compact('wish_list','wish_list_number','icon','categories','most_viewed_products','products','cart','cart_number','about','footer'));
    }

    public function searchProduct(Request $request){

        // dd($request->slug);

         $slug = $request->slug;

        //  return redirect()->route('product.details',$slug);

        $icon = Icon::orderBy('id','desc')->first();
        $categories = Category::all();
        $most_viewed_products = Product::orderBy('views','desc')->limit(6)->get();

        $products = DB::table('products')
                        ->join('categories','products.category_id','=','categories.id')
                        ->select('products.*','categories.name as category_name','categories.image as category_image')
                        ->where('products.status',1)
                        ->where('products.name','LIKE','%'.$request->slug.'%')
                        ->orWhere('categories.name','LIKE','%'.$request->slug.'%')
                        ->paginate(30);

        // $products = Product::orderBy('id','desc')->where('name','LIKE','%'.$request->product_name.'%')->paginate(16);

        $cart = DB::table('carts')
        ->join('products','carts.product_id','=','products.id')
        ->select('carts.*','products.name as product_name','products.image as product_image','products.slug as product_slug')
        ->where('carts.random_number',session('random_number'))
        ->orderBy('id','desc')
        ->get();
        $cart_number = Cart::where('random_number',session('random_number'))->count();
        $about = About::orderBy('id','desc')->first();
        $footer = Footer::orderBy('id','desc')->first();

        $wish_list = DB::table('wish_lists')
        ->join('products','wish_lists.product_id','=','products.id')
        ->select('wish_lists.*','products.name as product_name','products.image as product_image','products.slug as product_slug')
        ->where('wish_lists.random_number',session('random_number'))
        ->orderBy('id','desc')
        ->get();
        $wish_list_number = WishList::where('random_number',session('random_number'))->count();

        return view('public.shop',compact('wish_list','wish_list_number','icon','categories','most_viewed_products','products','cart','cart_number','about','footer'));
    }

    public function aboutUs(){
        $icon = Icon::orderBy('id','desc')->first();
        $categories = Category::all();

        $cart = DB::table('carts')
                    ->join('products','carts.product_id','=','products.id')
                    ->select('carts.*','products.name as product_name','products.image as product_image','products.slug as product_slug')
                    ->where('carts.random_number',session('random_number'))
                    ->orderBy('id','desc')
                    ->get();

        $cart_number = Cart::where('random_number',session('random_number'))->count();
        $about = About::orderBy('id','desc')->first();
        $footer = Footer::orderBy('id','desc')->first();

        $wish_list = DB::table('wish_lists')
                        ->join('products','wish_lists.product_id','=','products.id')
                        ->select('wish_lists.*','products.name as product_name','products.image as product_image','products.slug as product_slug')
                        ->where('wish_lists.random_number',session('random_number'))
                        ->orderBy('id','desc')
                        ->get();

        $wish_list_number = WishList::where('random_number',session('random_number'))->count();
        return view('public.about',compact('wish_list','wish_list_number','icon','categories','cart','cart_number','about','footer'));
    }
    
     public function aboutUs1(){
        $icon = Icon::orderBy('id','desc')->first();
        $categories = Category::all();

        $cart = DB::table('carts')
                    ->join('products','carts.product_id','=','products.id')
                    ->select('carts.*','products.name as product_name','products.image as product_image','products.slug as product_slug')
                    ->where('carts.random_number',session('random_number'))
                    ->orderBy('id','desc')
                    ->get();

        $cart_number = Cart::where('random_number',session('random_number'))->count();
        $about = About::orderBy('id','desc')->first();
        $footer = Footer::orderBy('id','desc')->first();

        $wish_list = DB::table('wish_lists')
                        ->join('products','wish_lists.product_id','=','products.id')
                        ->select('wish_lists.*','products.name as product_name','products.image as product_image','products.slug as product_slug')
                        ->where('wish_lists.random_number',session('random_number'))
                        ->orderBy('id','desc')
                        ->get();

        $wish_list_number = WishList::where('random_number',session('random_number'))->count();
        return view('public.privacy',compact('wish_list','wish_list_number','icon','categories','cart','cart_number','about','footer'));
    }

    public function offerProducts(){
        $icon = Icon::orderBy('id','desc')->first();
        $categories = Category::all();
        $most_viewed_products = Product::orderBy('views','desc')->where('status',1)->limit(3)->get();
        $cart = DB::table('carts')
                ->join('products','carts.product_id','=','products.id')
                ->select('carts.*','products.name as product_name','products.image as product_image','products.slug as product_slug')
                ->where('carts.random_number',session('random_number'))
                ->orderBy('id','desc')
                ->get();

        $cart_number = Cart::where('random_number',session('random_number'))->count();
        $about = About::orderBy('id','desc')->first();
        $footer = Footer::orderBy('id','desc')->first();

        $products = Product::orderBy('id','desc')->where('status',1)->where('prev_price','!=',null)->where('prev_price','!=',0)->where('price','<','prev_price')->paginate(16);
        $wish_list = DB::table('wish_lists')
        ->join('products','wish_lists.product_id','=','products.id')
        ->select('wish_lists.*','products.name as product_name','products.image as product_image','products.slug as product_slug')
        ->where('wish_lists.random_number',session('random_number'))
        ->orderBy('id','desc')
        ->get();
        $wish_list_number = WishList::where('random_number',session('random_number'))->count();
        return view('public.shop',compact('wish_list','wish_list_number','icon','categories','most_viewed_products','products','cart','cart_number','about','footer'));
    }

    public function applyCoupon(Request $request){
        if(Coupon::where('code',$request->coupon)->exists()){
            $date = date("Y-m-d");
            $data = Coupon::where('code',$request->coupon)->first();
            if(Coupon::where('code',$request->coupon)->where('start_date','<=',$date)->where('end_date','>=',$date)->exists()){

                if($request->amount < $data->min_qty){
                    Toastr::error('Your Cart Amount does not reach the minimum limit', 'Failed');
                    return redirect()->back();
                }
                else{
                    if($data->amount != null){
                        $icon = Icon::orderBy('id','desc')->first();
                        $categories = Category::all();
                        $cart = DB::table('carts')
                            ->join('products','carts.product_id','=','products.id')
                            ->select('carts.*','products.name as product_name','products.image as product_image','products.slug as product_slug')
                            ->where('carts.random_number',session('random_number'))
                            ->orderBy('id','desc')
                            ->get();
                        $cart_number = Cart::where('random_number',session('random_number'))->count();
                        $about = About::orderBy('id','desc')->first();
                        $footer = Footer::orderBy('id','desc')->first();
                        $discount = $data->amount;
                        session(['discount' => $discount]);
                        Coupon::where('code',$request->coupon)->increment('used',1);
                        $wish_list = DB::table('wish_lists')
                                ->join('products','wish_lists.product_id','=','products.id')
                                ->select('wish_lists.*','products.name as product_name','products.image as product_image','products.slug as product_slug')
                                ->where('wish_lists.random_number',session('random_number'))
                                ->orderBy('id','desc')
                                ->get();
                        $wish_list_number = WishList::where('random_number',session('random_number'))->count();
                        return view('public.cart',compact('wish_list','wish_list_number','icon','categories','cart','cart_number','about','footer','discount'));
                    }

                    if($data->percentage != null){
                        $icon = Icon::orderBy('id','desc')->first();
                        $categories = Category::all();
                        $cart = DB::table('carts')
                            ->join('products','carts.product_id','=','products.id')
                            ->select('carts.*','products.name as product_name','products.image as product_image','products.slug as product_slug')
                            ->where('carts.random_number',session('random_number'))
                            ->orderBy('id','desc')
                            ->get();
                        $cart_number = Cart::where('random_number',session('random_number'))->count();
                        $about = About::orderBy('id','desc')->first();
                        $footer = Footer::orderBy('id','desc')->first();

                            $amount = 60;
                            foreach ($cart as $key => $value) {
                                $amount = $amount+($value->price*$value->qty);
                            }

                        $discount = $amount*($data->percentage/100);
                        session(['discount' => $discount]);
                        Coupon::where('code',$request->coupon)->increment('used',1);
                        $wish_list = DB::table('wish_lists')
                        ->join('products','wish_lists.product_id','=','products.id')
                        ->select('wish_lists.*','products.name as product_name','products.image as product_image','products.slug as product_slug')
                        ->where('wish_lists.random_number',session('random_number'))
                        ->orderBy('id','desc')
                        ->get();
                        $wish_list_number = WishList::where('random_number',session('random_number'))->count();
                        return view('public.cart',compact('wish_list','wish_list_number','icon','categories','cart','cart_number','about','footer','discount'));
                    }
                }

            }
            else{
                Toastr::error('Coupon Validity does not exists', 'Failed');
                return redirect()->back();
            }
        }
        else{
            Toastr::error('Coupon Code does not exists', 'Failed');
            return redirect()->back();
        }

    }

    public function convertJsonToArray(){
        $products = Product::all();
        foreach($products as $item){
            $data = Product::where('id',$item->id)->first();
            if($data->photos != null){
                $my_array = json_decode($data->photos, true);
                $pics = implode(', ', $my_array);
                Product::where('id',$data->id)->update([
                    'pictures' => $pics
                ]);
            }
        }
        echo "Process has been completed";
    }
}
