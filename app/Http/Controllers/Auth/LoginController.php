<?php

namespace App\Http\Controllers\Auth;
use App\Icon;
use App\Category;
use App\Cart;
use App\About;
use Illuminate\Support\Facades\DB;
use App\Footer;
use Illuminate\Support\Facades\Auth;
use App\WishList;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    // protected $redirectTo = '/checkout/page';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo(){
        // User role
        $role = Auth::user()->role;

        // Check user role
        switch ($role) {
            case 1:
                return '/home';
                break;
            case 3:
                return '/home';
                break;
            case 2:
                return '/customer/dashboard';
                break;
            default:
                return '/login';
                break;
        }
    }

    public function loginPost()
    {
        if ($this->auth->attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))){
            return Redirect::intended();
        }
        return back();
    }

    public function showLoginForm(){
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

        return view('auth.login',compact('wish_list','wish_list_number','icon','categories','cart','cart_number','about','footer'));
    }
}
