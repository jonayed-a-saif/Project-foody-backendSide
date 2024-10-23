<?php

namespace App\Http\Controllers;
use App\User;
use App\Sale;
use App\Icon;
use App\Category;
use Illuminate\Support\Facades\Hash;
use App\Product;
use App\Cart;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\About;
use App\Footer;
use App\WishList;
use App\Shipping;
use App\Billing;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function getAllCustomerList(){
        $customers = User::where('role',2)->orderBy('id','desc')->paginate(20);
        return response()->json([
            'customers' => $customers
        ],200);
    }

    public function deleteCustomer($id){
        if(Sale::where('user_id',$id)->exists()){
            return response()->json([
                'Message' => "Password Confirmation Does not Match"
            ],404);
        }
        else{
            User::where('id',$id)->delete();
        }
    }

    public function customerDashboard(){
        $icon = Icon::orderBy('id','desc')->first();
        $categories = Category::all();
        $products = Product::orderBy('id','desc')->where('status',1)->get();
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

        $pendingOrders = Sale::where('user_id',Auth::user()->id)->where('sales.status',1)->paginate(10);
        $processingOrders = Sale::where('user_id',Auth::user()->id)->where('sales.status',2)->paginate(10);
        $completeOrders = Sale::where('user_id',Auth::user()->id)->where('sales.status',3)->paginate(10);
        $cancelledOrders = Sale::where('user_id',Auth::user()->id)->where('sales.status',0)->paginate(10);

        return view('public/customer_dashboard',compact('cancelledOrders','completeOrders','pendingOrders','processingOrders','wish_list','wish_list_number','icon','categories','products','cart','cart_number','about','footer'));
    }

    public function changePassword(Request $request){
        $this->validate($request,[
            'new' => 'required|min:6|max:20',
            'confirm' => 'required|min:6|max:20'
        ]);

        if($request->new != $request->confirm){
            Toastr::error('Password Not Matched', 'Successfull');
            return back();
        }
        else{
            User::where('id',Auth::user()->id)->update([
                'password' => Hash::make($request->new),
            ]);
            Toastr::success('Password has been Updated', 'Successfull');
            return back();
        }
    }

    public function orderDetails($slug){
        $icon = Icon::orderBy('id','desc')->first();
        $categories = Category::all();
        $products = Product::orderBy('id','desc')->where('status',1)->get();
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

        $sales_data = Sale::where('slug',$slug)->first();
        $shipping_data = Shipping::where('id',$sales_data->shipping_id)->first();

        $billing_data = DB::table('billings')
                            ->join('products','billings.product_id','products.id')
                            ->select('billings.*','products.name as product_name','products.image as product_image')
                            ->where('billings.sale_id',$sales_data->id)
                            ->get();

        return view('public/order_details',compact('sales_data','shipping_data','billing_data','wish_list','wish_list_number','icon','categories','products','cart','cart_number','about','footer'));
    }
}
