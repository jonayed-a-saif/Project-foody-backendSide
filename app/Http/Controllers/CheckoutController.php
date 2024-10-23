<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Session;
use Illuminate\Support\Facades\DB;
use App\Icon;
use Illuminate\Support\Str;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use App\Shipping;
use App\About;
use App\Sale;
use App\Billing;
use App\WishList;
use App\Footer;
use App\ShippingMethod;
use App\Packaging;
use App\User;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function checkoutPage(){
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
        $shipping_methods = ShippingMethod::all();
        $packagings = Packaging::all();
        return view('public.checkout',compact('wish_list','wish_list_number','icon','categories','cart','cart_number','about','footer','shipping_methods','packagings'));
    }

    public function checkout(Request $request){

        // dd($request);

        $carts = DB::table('carts')
            ->where('random_number', session('random_number'))
            ->get();

        if(count($carts)>0){
            $userid = DB::table('users')
                ->select('users.*')
                ->where('users.contact', $request->phone)
                ->orderBy('id', 'desc')
                ->first();



            if ($userid) {
                $user_id = $userid->id;
            } else {
                $user_id = User::insertGetId([
                    'name' => $request->name,
                    'contact' => $request->phone,
                    'created_at' => Carbon::now(),
                ]);
            }



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



            $amount = 0;
            foreach ($carts as $key => $value) {
                $amount = $amount + ($value->price * $value->qty);
            }

            $shipping_method = ShippingMethod::where('title', $request->shipping_method)->first();
            // $packaging = Packaging::where('title',$request->packaging)->first();

            $sale_id = Sale::insertGetId([
                'user_id'     => $user_id,
                'shipping_id' => $shipping_id,
                'subtotal'    => $amount,
                'shipping'    => $shipping_method->title . " " . ($shipping_method->duration) . " " . $shipping_method->price . " Tk",
                'total'       => ($amount - session('discount')) + ($shipping_method->price),
                'discount'    => session('discount'),
                'payment_type' => 'Cash On Delivery',
                'status'      => 1,
                'slug'        => time() . str::random(10),
                'created_at'  => Carbon::now()
            ]);

            session(['sale_id' => $sale_id]); //putting sell id in session to send email to the user in stripePaymentController
            session(['total' => $amount]);

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

            if($sale_id) {
                $endpoint = "https://login.esms.com.bd/api/v3/sms/send";
                $curl = curl_init($endpoint);
                
                $headers = array(
                        'Content-Type: application/json',
                        'Authorization: Bearer 93|A2aS2ka0V9xdt93Sk4Jqypvwh0mOMnpmEYgBIztM'
                        );
    
                $transactionMsg = 'আপনার অর্ডারটি সফল হয়েছে, '.$cart->price . ' টাকা, ' . 'পরিমাণ ' .  $cart->qty . 'টি ';
                $post_data = array(
                    'recipient' => '88'.$request->phone,
                    'sender_id' => '8809601003704',
                    'type' => 'plain',
                    'message' => $transactionMsg,
                        
                );
                //   dd($post_data);
                curl_setopt($curl, CURLOPT_URL, $endpoint);
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS,json_encode($post_data) );
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); 
                $post_response = curl_exec($curl);  

                $dataInsert = array(
                    'message' => $transactionMsg,
                    'recipients' => $request->phone
                );
                DB::table('messages')->insert($dataInsert);
            } 

            Toastr::success('Order has been placed', 'Successfull');
            return redirect('/');
        }else{
            Toastr::success('Product List Empty!. Please Add Product First.', 'Successfull');
            return redirect('/');
        }

        
    }
}
