<?php

namespace App\Http\Controllers;
use App\Cart;
use App\Product;
use Session;
use Illuminate\Support\Facades\DB;
use App\Icon;
use App\Footer;
use App\WishList;
use App\About;
use Illuminate\Support\Str;
use App\Category;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CartController extends Controller
{
    public function addToCart(Request $request){
        $this->validate($request,[
            'qty' => 'required|min:1',
        ]);

        if (Session::has('random_number')){
            $product_info = Product::where('id',$request->product_id)->first();

            if($request->qty > $product_info->stock){
                Toastr::warning('Stock Limit Exceed', 'Limit Crossed');
                return redirect()->back();
            }
            else{
                Product::where('id',$request->product_id)->decrement('stock',$request->qty);

                if(Cart::where('random_number',session('random_number'))->where('product_id',$request->product_id)->exists()){
                    session()->forget('discount');
                    Cart::where('random_number',session('random_number'))->where('product_id',$request->product_id)->increment('qty',$request->qty);
                    Toastr::success('Product Added to the Cart', 'Successfull');
                    return redirect()->back();
                }
                else{
                    session()->forget('discount');
                    Cart::insert([
                        'random_number' => session('random_number'),
                        'product_id' => $request->product_id,
                        'price' => $product_info->price,
                        'qty' => $request->qty,
                        'created_at' => Carbon::now()
                    ]);

                    Toastr::success('Product Added to the Cart', 'Successfull');
                    return redirect()->back();
                }
            }
        }
        else{
            $random_number = str::random(10);
            session(['random_number' => $random_number]);

            $product_info = Product::where('id',$request->product_id)->first();

            if($request->qty > $product_info->stock){
                Toastr::warning('Stock Limit Exceed', 'Limit Crossed');
                return redirect()->back();
            }
            else{
                Product::where('id',$request->product_id)->decrement('stock',$request->qty);

                if(Cart::where('random_number',session('random_number'))->where('product_id',$request->product_id)->exists()){
                    session()->forget('discount');
                    Cart::where('random_number',session('random_number'))->where('product_id',$request->product_id)->increment('qty',$request->qty);
                    Toastr::success('Product Added to the Cart', 'Successfull');
                    return redirect()->back();
                }
                else{
                    session()->forget('discount');
                    Cart::insert([
                        'random_number' => session('random_number'),
                        'product_id' => $request->product_id,
                        'price' => $product_info->price,
                        'qty' => $request->qty,
                        'created_at' => Carbon::now()
                    ]);

                    Toastr::success('Product Added to the Cart', 'Successfull');
                    return redirect()->back();
                }
            }
        }
    }


    public function addToBuy(Request $request)
    {
        $this->validate($request, [
            'qty' => 'required|min:1',
        ]);

        if (Session::has('random_number')) {
            $product_info = Product::where('id', $request->product_id)->first();

            if ($request->qty > $product_info->stock) {
                Toastr::warning('Stock Limit Exceed', 'Limit Crossed');
                return redirect()->back();
            } else {
                Product::where('id', $request->product_id)->decrement('stock', $request->qty);

                if (Cart::where('random_number', session('random_number'))->where('product_id', $request->product_id)->exists()) {
                    session()->forget('discount');
                    Cart::where('random_number', session('random_number'))->where('product_id', $request->product_id)->increment('qty', $request->qty);
                    Toastr::success('Product Added to the Buy', 'Successfull');
                    return redirect('checkout/page');
                } else {
                    session()->forget('discount');
                    Cart::insert([
                        'random_number' => session('random_number'),
                        'product_id' => $request->product_id,
                        'price' => $product_info->price,
                        'qty' => $request->qty,
                        'created_at' => Carbon::now()
                    ]);

                    Toastr::success('Product Added to the Buy', 'Successfull');
                    return redirect('checkout/page');
                }
            }
        } else {
            $random_number = str::random(10);
            session(['random_number' => $random_number]);

            $product_info = Product::where('id', $request->product_id)->first();

            if ($request->qty > $product_info->stock) {
                Toastr::warning('Stock Limit Exceed', 'Limit Crossed');
                return redirect()->back();
            } else {
                Product::where('id', $request->product_id)->decrement('stock', $request->qty);

                if (Cart::where('random_number', session('random_number'))->where('product_id', $request->product_id)->exists()) {
                    session()->forget('discount');
                    Cart::where('random_number', session('random_number'))->where('product_id', $request->product_id)->increment('qty', $request->qty);
                    Toastr::success('Product Added to the Buy', 'Successfull');
                    return redirect('checkout/page');
                } else {
                    session()->forget('discount');
                    Cart::insert([
                        'random_number' => session('random_number'),
                        'product_id' => $request->product_id,
                        'price' => $product_info->price,
                        'qty' => $request->qty,
                        'created_at' => Carbon::now()
                    ]);

                    Toastr::success('Product Added to the Buy', 'Successfull');
                  return redirect('checkout/page');
                }
            }
        }
    }

    public function deleteCart($id){
        $product = Cart::where('id',$id)->first();
        Product::where('id',$product->product_id)->increment('stock',$product->qty);
        session()->forget('discount');
        Cart::where('id',$id)->delete();
        Toastr::error('Cart Item Deleted', 'Successfull');
        return redirect()->back();
    }

    public function viewCart(){
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
        $discount = 0;
        $wish_list = DB::table('wish_lists')
                    ->join('products','wish_lists.product_id','=','products.id')
                    ->select('wish_lists.*','products.name as product_name','products.image as product_image','products.slug as product_slug')
                    ->where('wish_lists.random_number',session('random_number'))
                    ->orderBy('id','desc')
                    ->get();
        $wish_list_number = WishList::where('random_number',session('random_number'))->count();
        return view('public.cart',compact('wish_list','wish_list_number','icon','categories','cart','cart_number','about','footer','discount'));
    }

    public function addToWishList(Request $request){

        $this->validate($request,[
            'qty' => 'required|min:1',
        ]);

        if (Session::has('random_number')){
            $product_info = Product::where('id',$request->product_id)->first();

            if(WishList::where('random_number',session('random_number'))->where('product_id',$request->product_id)->exists()){
                WishList::where('random_number',session('random_number'))->where('product_id',$request->product_id)->increment('qty',$request->qty);
                Toastr::success('Product Added to the WishList', 'Successfull');
                return redirect()->back();
            }
            else{
                WishList::insert([
                    'random_number' => session('random_number'),
                    'product_id' => $request->product_id,
                    'price' => $product_info->price,
                    'qty' => $request->qty,
                    'created_at' => Carbon::now()
                ]);

                Toastr::success('Product Added to the WishList', 'Successfull');
                return redirect()->back();
            }

        }
        else{

            $random_number = str::random(10);
            session(['random_number' => $random_number]);
            $product_info = Product::where('id',$request->product_id)->first();

            if(WishList::where('random_number',session('random_number'))->where('product_id',$request->product_id)->exists()){
                WishList::where('random_number',session('random_number'))->where('product_id',$request->product_id)->increment('qty',$request->qty);
                Toastr::success('Product Added to the WishList', 'Successfull');
                return redirect()->back();
            }
            else{
                WishList::insert([
                    'random_number' => session('random_number'),
                    'product_id' => $request->product_id,
                    'price' => $product_info->price,
                    'qty' => $request->qty,
                    'created_at' => Carbon::now()
                ]);
                Toastr::success('Product Added to the WishList', 'Successfull');
                return redirect()->back();
            }

        }
    }

    public function viewWishList(){
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
        $discount = 0;
        $wish_list = DB::table('wish_lists')
                    ->join('products','wish_lists.product_id','=','products.id')
                    ->select('wish_lists.*','products.name as product_name','products.image as product_image','products.slug as product_slug')
                    ->where('wish_lists.random_number',session('random_number'))
                    ->orderBy('id','desc')
                    ->get();
        $wish_list_number = WishList::where('random_number',session('random_number'))->count();
        return view('public.wishlist',compact('wish_list','wish_list_number','icon','categories','cart','cart_number','about','footer','discount'));
    }

    public function deleteWishList($id){
        WishList::where('id',$id)->delete();
        Toastr::error('WishList Item Deleted', 'Successfull');
        return redirect()->back();
    }

    public function updateCartQuantity(Request $request){
        if($request->item_id){
            foreach ($request->item_id as $value) {
                Cart::findOrFail($value)->update([
                    'qty' => $request->qty[$value],
                ]);
            }
            Toastr::success('Cart Item Updated', 'Successfull');
            return redirect()->back();
        }else{
            Toastr::success('Cart Item Empty', 'Successfull');
            return redirect()->back();
        }
      
    }
}
