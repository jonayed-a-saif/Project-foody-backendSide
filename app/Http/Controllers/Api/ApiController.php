<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Category;
use App\Subcategory;
use App\Product;
use App\Cart;
use App\Shipping;
use Illuminate\Support\Str;
use App\ShippingMethod;
use App\Packaging;
use App\Sale;
use App\Coupon;
use App\Poster;
use App\Billing;
use App\About;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Icon;
use App\Banner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\WishList;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Facades\DataTable;

class ApiController extends Controller
{
    public function userLogin(Request $request)
    {

        $this->validate($request, [
            'contact'    => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['contact' => $request->contact, 'password' => $request->password])) {

            $id = Auth::user()->id;
            $name = Auth::user()->name;
            $role = Auth::user()->role;
            $email = Auth::user()->email;
            $contact = Auth::user()->contact;

            $data = array('id' => $id, 'name' => $name, 'role' => $role, 'email' => $email, 'contact' => $contact);
            return response()->json(['success' => true, 'data' => $data]);
        }

        return response()->json([
            'success' => false,
            'data' => []
        ])->setStatusCode(401);
    }

    public function userRegistration(Request $request)
    {

        $data = array();
        $data['contact'] = $request->contact;
        $data['password'] = Hash::make($request->password);
        $data['name'] = $request->name;
        $data['email'] = $request->email;

        if ($request->contact != null) {
            $phone_check = DB::table('users')->select('id', 'contact', 'password', 'name', 'email')->where('contact', $request->contact)->first();
        } else {
            $phone_check = '';
        }

        

       if ($phone_check) {
            return response()->json([
                'success' => false,
                'message' => 'Mobile Number already Exists'
            ]);
        } else {

            $id = DB::table('users')->insertGetId($data);

            $user_details = DB::table('users')->select('id', 'contact', 'password', 'name', 'email')->where('id', $id)->where('contact', $request->contact)->first();

            return response()->json([
                'success' => true,
                'data' => $user_details,
            ]);
        }
    }

    public function getAllProducts()
    {
        $products = DB::table('products')
                        ->leftJoin('users','products.user_id','=','users.id')
                        ->leftJoin('categories','products.category_id','=','categories.id')
                        ->select('products.id', 'users.name as user_name','categories.name as category_name', 'products.name', 'products.stock', 'products.image', 'products.price', 'products.slug', 'products.created_at', 'products.status')
                        ->orderBy('id','desc')
                        ->get()
                        ;
        return response()->json($products);
    }

    public function getProducts()
    {
        $data = array();

        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->paginate(20);

        foreach ($products as $product) {
            $product->product_name = preg_replace('/[^0-9a-zA-Z]+/', ' ', $product->name);
        }

        // $result = $this->paginate($data);

        return response()->json([
            'success' => true,
            'data' => $products,
        ]);
    }

    public function productSearch(Request $request)
    {

        $term = $request->term;

        // $newterm = str_replace(' ', '-',  $term);
        $products = DB::table('products')
                        ->join('categories','products.category_id','=','categories.id')
                        ->select('products.*','categories.name as category_name')
                        ->where('status',1)
                        ->where('products.name','LIKE','%'.$term.'%')
                        ->orWhere('categories.name','LIKE','%'.$term.'%')
                        ->orderBy('id','desc')
                        ->get();
        foreach($products as $product){
            $product->product_name = preg_replace('/[^0-9a-zA-Z]+/', ' ', $product->name);
        }

        $output = array();
         if($products->count() > 0)
         {
          foreach($products as $row)
          {
           $temp_array = array();
           $temp_array['value'] = $row->name;
           $temp_array['id'] = $row->id;
           $temp_array['slug'] = $row->slug;
           $temp_array['label'] = '<img src="'.URL::to('/').'/product_images/'.$row->image.'" width="70" />&nbsp;&nbsp;&nbsp;'.$row->name.'';
           $output[] = $temp_array;
          }
         }
         else
         {
          $output['value'] = '';
          $output['label'] = 'No Record Found';
         }

         echo json_encode($output);
    }

    public function paginate($items, $perPage = 20, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function getCategoryList()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return response()->json([
            'success' => true,
            'data' => $categories,
        ]);
    }

    public function getSubCategoryList()
    {

        $subcategories = DB::table('sub_categories')
            ->join('categories', 'sub_categories.category_id', '=', 'categories.id')
            ->select('sub_categories.*', 'categories.name as category_name')
            ->orderBy('sub_categories.name', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $subcategories,
        ]);
    }

    public function getSubCategoryListByCategoryID(Request $request)
    {

        $subcategories = DB::table('sub_categories')
            ->join('categories', 'sub_categories.category_id', '=', 'categories.id')
            ->where('categories.id', $request->category_id)
            ->select('sub_categories.*', 'categories.name as category_name')
            ->orderBy('sub_categories.name', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $subcategories,
        ]);
    }

    public function getChildCategoryListBySubcategoryID(Request $request)
    {

        $childCatgories = DB::table('child_categories')
            ->join('sub_categories', 'child_categories.subcategory_id', '=', 'sub_categories.id')
            ->join('categories', 'child_categories.category_id', '=', 'categories.id')
            ->where('sub_categories.id', $request->sub_category_id)
            ->select('child_categories.*', 'sub_categories.name as subcategory_name', 'categories.name as category_name')
            ->orderBy('child_categories.name', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $childCatgories,
        ]);
    }


    public function getChildCategoryList()
    {

        $childCatgories = DB::table('child_categories')
            ->join('sub_categories', 'child_categories.subcategory_id', '=', 'sub_categories.id')
            ->join('categories', 'child_categories.category_id', '=', 'categories.id')
            ->select('child_categories.*', 'sub_categories.name as subcategory_name', 'categories.name as category_name')
            ->orderBy('child_categories.name', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $childCatgories,
        ]);
    }

    public function categoryWiseProduct($slug)
    {

        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->where('status', 1)
            ->where('categories.slug', $slug)
            ->orderBy('id', 'desc')
            ->paginate(50);

        return response()->json([
            'success' => true,
            'data' => $products,
        ]);
    }

    public function subcategoryWiseProduct($slug)
    
    {
         $getCategory = DB::table('home_categories')
        ->select('home_categories.*')
        ->where('home_categories.id', 1)
            ->get();
        
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('sub_categories', 'products.subcategory_id', '=', 'sub_categories.id')
            ->where('status', 1)
            ->where('sub_categories.slug', $slug)
            ->select('products.*')
            ->orderBy('products.id', 'desc')
            ->paginate(10);
            

        return response()->json([
            'success' => true,
            'homepage_category' => $getCategory,
            'data' => $products,
        ]);
    }

    public function childcategoryWiseProduct($slug)
    {

        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('sub_categories', 'products.subcategory_id', '=', 'sub_categories.id')
            ->join('child_categories', 'products.childcategory_id', '=', 'child_categories.id')
            ->select('products.*', 'categories.name as category_name', 'sub_categories.name as subcategory_name', 'child_categories.name as childcategory_name')
            ->where('status', 1)
            ->where('childcategory_id', $slug)
            ->orderBy('id', 'desc')
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $products,
        ]);
    }

    public function getCartProducts($random_number)
    {
        $cart = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select('carts.*', 'products.name as product_name', 'products.image as product_image', 'products.slug as product_slug')
            ->where('carts.random_number', $random_number)
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $cart,
        ]);
    }

    public function addProductsToCart(Request $request)
    {

        $product_info = Product::where('id', $request->product_id)->first();
        if ($request->qty > $product_info->stock) {
            return response()->json([
                'success' => false,
                'data' => "Out Of Stock",
            ]);
        } else {
            if (Cart::where('random_number', $request->random_number)->where('product_id', $request->product_id)->exists()) {
                Cart::where('random_number', $request->random_number)->where('product_id', $request->product_id)->update(array('qty' => $request->qty));;
                return response()->json([
                    'success' => true,
                    'Message' => "Product Added to the Cart"
                ]);
            } else {
                Cart::insert([
                    'random_number' => $request->random_number,
                    'product_id' => $request->product_id,
                    'price' => $product_info->price,
                    'qty' => $request->qty,
                    'created_at' => Carbon::now()
                ]);
                return response()->json([
                    'success' => true,
                    'Message' => "Product Added to the Cart"
                ]);
            }
        }
    }
    
    
 public function deleteProductsToCart(Request $request)
    {

       
            if (Cart::where('random_number', $request->random_number)->where('product_id', $request->product_id)->exists()) {
                Cart::where('random_number', $request->random_number)->where('product_id', $request->product_id)->delete();
                return response()->json([
                    'success' => true,
                    'Message' => "Product Delete to the Cart"
                ]);
            
        }
    }
    
    

    public function deleteCartitem($id)
    {
        Cart::where('id', $id)->delete();
        return response()->json([
            'success' => true,
            'Message' => "Product deleted from the Cart"
        ]);
    }

    public function searchProduct(Request $request)
    {

        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name', 'categories.image as category_image')
            ->where('products.status', 1)
            ->where('products.name', 'LIKE', '%' . $request->product_name . '%')
            ->orWhere('categories.name', 'LIKE', '%' . $request->product_name . '%')
            ->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $products,
        ]);
    }

    public function relatedProduct(Request $request)
    {

        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name', 'categories.image as category_image')
            ->where('products.status', 1)
            ->orWhere('categories.name', 'LIKE', '%' . $request->category_name . '%')
            ->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $products,
        ]);
    }



    public function dealsmonth()
    {

        $getCategory = DB::table('home_categories')
        ->select('home_categories.*')
        ->where('home_categories.id', 1)
            ->get();

        $products = DB::table('home_category_products')
        ->join('products', 'home_category_products.product_id', '=', 'products.id')
        ->select('products.*')
        ->where('home_category_products.home_category_id', 1)
            ->orderBy('products.id', 'desc')
            ->paginate(6);

        return response()->json([
            'success' => true,
            'homepage_category' => $getCategory,
            'data' => $products,
        ]);
    }

    public function flashsale()
    {

        $getCategory = DB::table('home_categories')
        ->select('home_categories.*')
        ->where('home_categories.id', 6)
        ->get();

        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->paginate(24);

        return response()->json([
            'success' => true,
            'homepage_category' => $getCategory,
            'data' => $products,
        ]);
    }

    public function trending()
    {

        $getCategory = DB::table('home_categories')
        ->select('home_categories.*')
        ->where('home_categories.id', 1)
        ->get();

        $products = DB::table('home_category_products')
        ->join('products', 'home_category_products.product_id', '=', 'products.id')
        ->select('products.*')
        ->where('home_category_products.home_category_id', 1)
        ->orderBy('products.id', 'desc')
        ->paginate(6);

        return response()->json([
            'success' => true,
            'homepage_category' => $getCategory,
            'data' => $products,
        ]);
    }

    public function featureproduct()
    {

        $getCategory = DB::table('home_categories')
        ->select('home_categories.*')
        ->where('home_categories.id', 12)
        ->get();

        $products =  Product::orderBy('id','desc')->where('status',1)->where('prev_price','!=',null)->where('prev_price','!=',0)->where('price','<','prev_price')->paginate(30);

        return response()->json([
            'success' => true,
            'homepage_category' => $getCategory,
            'data' => $products,
        ]);
    }

    public function newarrival()
    {

        $getCategory = DB::table('home_categories')
        ->select('home_categories.*')
        ->where('home_categories.id', 6)
        ->get();

        $products = DB::table('home_category_products')
        ->join('products', 'home_category_products.product_id', '=', 'products.id')
        ->select('products.*')
        ->where('home_category_products.home_category_id', 6)
        ->orderBy('products.id', 'desc')
        ->paginate(6);

        return response()->json([
            'success' => true,
            'homepage_category' => $getCategory,
            'data' => $products,
        ]);
    }

    public function toprated()
    {

        $getCategory = DB::table('home_categories')
        ->select('home_categories.*')
        ->where('home_categories.id', 4)
        ->get();

        $products = DB::table('home_category_products')
        ->join('products', 'home_category_products.product_id', '=', 'products.id')
        ->select('products.*')
        ->where('home_category_products.home_category_id', 4)
        ->orderBy('products.id', 'desc')
        ->paginate(6);

        return response()->json([
            'success' => true,
            'homepage_category' => $getCategory,
            'data' => $products,
        ]);
    }

    

    public function categorywisehomepageproduct(Request $request)
    {

        $getCategory = DB::table('home_categories')
        ->select('home_categories.*')
        ->where('home_categories.id', $request->id)
        ->get();

        $products = DB::table('home_category_products')
        ->join('products', 'home_category_products.product_id', '=', 'products.id')
        ->select('products.*')
        ->where('home_category_products.home_category_id', $request->id)
        ->orderBy('products.id', 'desc')
        ->paginate(20);

        return response()->json([
            'success' => true,
            'homepage_category' => $getCategory,
            'data' => $products,
        ]);
    }


    public function aboutUs()
    {
        $about = About::orderBy('id', 'desc')->first();
        return response()->json([
            'success' => true,
            'data' => $about,
        ]);
    }

    public function offerProducts()
    {

        $products = Product::orderBy('id', 'desc')->where('status', 1)->where('prev_price', '!=', null)->where('prev_price', '!=', 0)->where('price', '<', 'prev_price')->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $products,
        ]);
    }

    public function getIconLogoTitle()
    {
        $icon = Icon::orderBy('id', 'desc')->first();
        return response()->json([
            'success' => true,
            'data' => $icon,
        ]);
    }

    public function getWishListProduct($random_number)
    {
        $wish_list = DB::table('wish_lists')
            ->join('products', 'wish_lists.product_id', '=', 'products.id')
            ->select('wish_lists.*', 'products.name as product_name', 'products.image as product_image', 'products.slug as product_slug')
            ->where('wish_lists.random_number', $random_number)
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $wish_list,
        ]);
    }

    public function addProductToWishList(Request $request)
    {

        $product_info = Product::where('id', $request->product_id)->first();

        if (WishList::where('random_number', $request->random_number)->where('product_id', $request->product_id)->exists()) {
            WishList::where('random_number', $request->random_number)->where('product_id', $request->product_id)->increment('qty', $request->qty);
            return response()->json([
                'success' => true,
                'Message' => "Product Added to the WishList"
            ]);
        } else {
            WishList::insert([
                'random_number' => $request->random_number,
                'product_id' => $request->product_id,
                'price' => $product_info->price,
                'qty' => $request->qty,
                'created_at' => Carbon::now()
            ]);
            return response()->json([
                'success' => true,
                'Message' => "Product Added to the WishList"
            ]);
        }
    }

    public function deleteProductFromWishList($id)
    {
        WishList::where('id', $id)->delete();
        return response()->json([
            'success' => true,
            'Message' => "Product deleted from the WishList"
        ]);
    }

    public function getShippingMethods()
    {
        $shipping_method = ShippingMethod::all();
        return response()->json([
            'success' => true,
            'data' => $shipping_method,
        ]);
    }

    public function getPackagingLists()
    {
        $packaging = Packaging::all();
        return response()->json([
            'success' => true,
            'data' => $packaging,
        ]);
    }

    public function checkout(Request $request)
    {

        $shipping_id = Shipping::insertGetId([
            'name' => $request->name,
            'country' => $request->country,
            'city' => $request->city,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'order_notes' => $request->order_note,
            'created_at' => Carbon::now(),
        ]);

        $carts = DB::table('carts')
            ->where('random_number', $request->random_number)
            ->get();

        $amount = 0;
        foreach ($carts as $key => $value) {
            $amount = $amount + ($value->price * $value->qty);
        }

        $shipping_method = ShippingMethod::where('title', $request->shipping_method)->first();
        $packaging = Packaging::where('title', $request->packaging)->first();

        $sale_id = Sale::insertGetId([
            'user_id'     => $request->user_id,
            'shipping_id' => $shipping_id,
            'subtotal'    => $amount,
             'shipping'    => $shipping_method->title . " " . ($shipping_method->duration) . " " . $shipping_method->price . " Tk",
            'total'       => ($request->total - $request->discount) + ($shipping_method->price),
            'discount'    => $request->discount,
            'payment_type' => 'Cash On Delivery',
            'status'      => 1,
            'slug'        => time() . str::random(10),
            'created_at'  => Carbon::now()
        ]);

        foreach ($carts as $cart) {
            Billing::insert([
                'sale_id'    => $sale_id,
                'product_id' => $cart->product_id,
                'price'      => $cart->price,
                'qty'        => $cart->qty,
                'created_at' => Carbon::now(),
            ]);
            Cart::where('id', $cart->id)->delete();
        }

        return response()->json([
            'success' => true,
            'Message' => 'Order has been placed',
        ]);
    }

    public function applyCoupon(Request $request)
    {

        if (Coupon::where('code', $request->coupon)->exists()) {
            $date = date("Y-m-d");
            $data = Coupon::where('code', $request->coupon)->first();
            if (Coupon::where('code', $request->coupon)->where('start_date', '<=', $date)->where('end_date', '>=', $date)->exists()) {

                if ($request->amount < $data->min_qty) {
                    return response()->json([
                        'success' => false,
                        'Message' => 'Your Cart Amount does not reach the minimum limit',
                    ]);
                } else {
                    if ($data->amount != null) {

                        $discount = $data->amount;
                        Coupon::where('code', $request->coupon)->increment('used', 1);

                        return response()->json([
                            'success' => true,
                            'data' => $discount,
                        ]);
                    }

                    if ($data->percentage != null) {

                        $cart = DB::table('carts')
                            ->join('products', 'carts.product_id', '=', 'products.id')
                            ->select('carts.*', 'products.name as product_name', 'products.image as product_image', 'products.slug as product_slug')
                            ->where('carts.random_number', $request->random_number)
                            ->orderBy('id', 'desc')
                            ->get();

                        $amount = 0;
                        foreach ($cart as $key => $value) {
                            $amount = $amount + ($value->price * $value->qty);
                        }

                        $discount = $amount * ($data->percentage / 100);
                        Coupon::where('code', $request->coupon)->increment('used', 1);

                        return response()->json([
                            'success' => true,
                            'data' => $discount,
                        ]);
                    }
                }
            } else {
                return response()->json([
                    'success' => false,
                    'Message' => 'Coupon validity Does not Exists',
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'Message' => 'Coupon Code Does not Exists',
            ]);
        }
    }

    public function getSlider()
    {
        $sliders = Banner::orderBy('id', 'desc')->get();
        return response()->json([
            'success' => true,
            'data' => $sliders,
        ]);
    }

    public function getPoster()
    {
        $posters = Poster::orderBy('id', 'desc')->get();
        return response()->json([
            'success' => true,
            'data' => $posters,
        ]);
    }

    public function getMyOrders($id)
    {
        $my_orders = Sale::where('user_id', $id)->orderBy('id', 'desc')->get();
        return response()->json([
            'success' => true,
            'data' => $my_orders,
        ]);
    }

    public function getMyOrderDetails($id)
    {
        $sale = Sale::where('id', $id)->first();

        $shipping_info = Shipping::where('id', $sale->shipping_id)->first();
        $billing_info = DB::table('billings')
            ->join('products', 'billings.product_id', '=', 'products.id')
            ->select('billings.*', 'products.name as product_name', 'products.image as product_image')
            ->where('sale_id', $id)
            ->get();

        return response()->json([
            'success' => true,
            'sale' => $sale,
            'shipping_info' => $shipping_info,
            'billing_info' => $billing_info,
        ]);
    }
}
